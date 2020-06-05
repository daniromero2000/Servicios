<?php

namespace App\Http\Controllers\Admin\ListProducts;

use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\ListProducts\ListProduct;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListProductController extends Controller
{
    private $productListInterface;
    private $listProductInterface;
    private $giveAwayInterface;
    private $factorInterface;

    public function __construct(
        ListProductRepositoryInterface $listProductRepositoryInterface,
        ProductListRepositoryInterface $productListRepositoryInterface,
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->listProductInterface = $listProductRepositoryInterface;
        $this->giveAwayInterface    = $listGiveAwayRepositoryInterface;
        $this->factorInterface      = $factorRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $listProducts = $this->listProductInterface->getAlllistProducts();
        return response()->json($listProducts);
    }

    public function store(Request $request)
    {
        if ($request->type == 'massive') {
            DB::table('list_products')->truncate();
            $handle = fopen($request->file('listProduct'), "r") or die("Unable to open file!");
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                if ($data[0] != 'CODIGO' && $data[1] != 'NOMBRE') {
                    $product = ['sku' => $data[0], 'item' => $data[1], 'base_cost' => $data[2], 'iva_cost' => $data[3], 'cash_cost' => $data[4],'protection' => $data[5], 'min_tolerance' => $data[6], 'max_tolerance' => $data[7]];
                    $listProduct =  $this->listProductInterface->createlistProduct($product);
                }
            }
            return response()->json($listProduct);
        } else {
            $data = $request->input();

            $listProduct =  $this->listProductInterface->createlistProduct($data);

            return response()->json($listProduct);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        $listProduct =  $this->listProductInterface->updateListProduct($data);

        return response()->json($listProduct);
    }

    public function destroy($id)
    {
        $listProduct =  $this->listProductInterface->deleteListProduct($id);

        return response()->json($listProduct);
    }

    public function getProduct($sku)
    {
        $product = $this->listProductInterface->findListProductBySku($sku);

        return $product;
    }


    public function getDataPriceProduct($product_id)
    {
        $dataProduct = [];
        $product = $this->listProductInterface->findListProductById($product_id);
        $product = $product->toArray();
        $currentProductLists = $this->productListInterface->getAllCurrentProductLists();
        $currentProductLists = $currentProductLists->toArray();
        $priceGiveAway = $this->giveAwayInterface->getPriceGiveAwayProduct($product['base_cost']);
        $priceGiveAway = $priceGiveAway->total;
        $protectionVat = $product['protection'] * 1.19;
        $factors = $this->factorInterface->getAllFactors();
        $factors = $factors->toArray();
        $monthlyRate = ($factors[0]['value'] / 100);
        $bond = 1 - ($factors[1]['value'] / 100);
        $optionalIncrement = 1 - ($factors[2]['value'] / 100);
        $cashPromotionLowZone = 0;
        $percentageProtectionDividedPrice = round(($protectionVat / $product['iva_cost']) * 100 , 2);
        foreach ($currentProductLists as $key => $productList) {
            if($productList['apply_protection'] == 1){
                $protectionVat = $protectionVat;
                $percentageProtectionDividedPrice = $percentageProtectionDividedPrice;
            }else{
                $protectionVat = 0;
                $percentageProtectionDividedPrice = 0;
            }
            $normalPublicPrice = round(($product['iva_cost'] + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / 0.95);
            if ($productList['zone'] == 'MEDIA') {
                if($percentageProtectionDividedPrice == 0){
                    $percentageProtection = 0;
                }elseif($percentageProtectionDividedPrice <= 10){
                    $percentageProtection = 70;
                }elseif($percentageProtectionDividedPrice > 10 && $percentageProtectionDividedPrice <= 20){
                    $percentageProtection = 80;
                }else{
                    $percentageProtection = 90;
                }
                $cashPromotion                   = round(($product['iva_cost'] - ($protectionVat * ($percentageProtection / 100))) / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice            = $cashPromotion;
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $basePublicPriceOportuyaCustomer = round(($product['iva_cost'] - $protectionVat)/((100 - $productList['public_price_percentage']) / 100));
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_blue']) / 100));
                $blueBondPrice                   = round(($basePublicPriceOportuyaCustomer * (1 - ($productList['bond_blue'] / 100))) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
            } elseif ($productList['zone'] == 'BAJA') {
                $cashPromotion                   = round(($product['iva_cost'] - $protectionVat) / ((100 - $productList['cash_margin']) / 100));
                $cashPromotionLowZone            = $cashPromotion;
                $promotionPublicPrice            = round((($product['iva_cost'] - ($protectionVat * 0.5)) + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / $bond);
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer = round((($product['iva_cost'] - ($protectionVat * 1.5)) + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / $bond);
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $blueBondPrice                   = round(($basePublicPriceOportuyaCustomer * (1 - ($productList['bond_blue'] / 100))) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            } else {
                $cashPromotion                   = round($cashPromotionLowZone / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice            = round((($product['iva_cost'] - ($protectionVat * 0.5)) + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / $bond);
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer = round((($product['iva_cost'] - ($protectionVat * 1.5)) + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / $bond);
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $blueBondPrice                   = round(($basePublicPriceOportuyaCustomer * (1 - ($productList['bond_blue'] / 100))) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round($blackPublicPrice * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            }

            $dataProduct[$productList['name']] = [
                'normal_public_price'                 => $normalPublicPrice,
                'cash_promotion'                      => $cashPromotion,
                'promotion_public_price'              => $promotionPublicPrice,
                'traditional_credit_price'            => $traditionalCreditPrice * 12,
                'traditional_credit_bond_price'       => $traditionalCreditBondPrice * 12,
                'base_public_price_oportuya_customer' => $basePublicPriceOportuyaCustomer,
                'blue_public_price'                   => $bluePublicPrice,
                'blue_bond_price'                     => $blueBondPrice * 12,
                'black_public_price'                  => $blackPublicPrice,
                'black_bond_price'                    => $blackBondPrice * 12,
            ];
        }

        return $dataProduct;
    }
}
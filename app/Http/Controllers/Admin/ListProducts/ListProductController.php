<?php

namespace App\Http\Controllers\Admin\ListProducts;

use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


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
        $data = $request->input();
        dd($data);

        $listProduct =  $this->listProductInterface->createlistProduct($data);
        dd($listProduct);
    }

    public function getDataPriceProduct($product_id){
        $dataProduct = [];
        $product = $this->listProductInterface->findListProductById($product_id);
        $product = $product->toArray();
        $currentProductLists = $this->productListInterface->getAllCurrentProductLists();
        $currentProductLists = $currentProductLists->toArray();
        $priceGiveAway = $this->giveAwayInterface->getPriceGiveAwayProduct($product['base_cost']);
        $priceGiveAway = $priceGiveAway->total;
        $proteccionVat = $product['protection'] * 1.19;
        $factors = $this->factorInterface->getAllFactors();
        $factors = $factors->toArray();
        $monthlyRate = ($factors[0]['value']/100);
        $bond = 1-($factors[1]['value']/100);
        $optionalIncrement = 1-($factors[2]['value']/100);
        foreach ($currentProductLists as $key => $productList) {
            $normalPublicPrice = round(($product['iva_cost']+$priceGiveAway)/((100-$productList['public_price_percentage'])/100)/0.95);
            $cashPromotion     = round($product['iva_cost']/((100-$productList['cash_margin'])/100));
            if($productList['zone'] == 'MEDIA'){
                $promotionPublicPrice       = $cashPromotion;
                $traditionalCreditPrice     = round(($promotionPublicPrice*1.119)*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
                $traditionalCreditBondPrice = round(($promotionPublicPrice*1.119)*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
                $bluePublicPrice            = round($promotionPublicPrice*((100-$productList['percentage_credit_card_blue'])/100));
                $blueBondPrice              = round(($promotionPublicPrice*(1-($productList['bond_blue']/100)))*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
                $blackPublicPrice           = round($promotionPublicPrice*((100-$productList['percentage_credit_card_black'])/100));
                $blackBondPrice             = round(($promotionPublicPrice*(1-($productList['bond_black']/100)))*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
            }elseif($productList['zone'] == 'BAJA'){
                $promotionPublicPrice       = round((($product['iva_cost']-$proteccionVat)+$priceGiveAway)/((100-$productList['public_price_percentage'])/100)/0.95);
                $traditionalCreditPrice     = round(($promotionPublicPrice*1)*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
                $traditionalCreditBondPrice = round($traditionalCreditPrice * (1-($productList['bond_traditional']/100)));
                $bluePublicPrice            = round((($product['iva_cost']-($proteccionVat*1.5))+$priceGiveAway)/((100-$productList['public_price_percentage'])/100)/0.95);
                $blueBondPrice              = round(($promotionPublicPrice*(1-($productList['bond_blue']/100)))*($monthlyRate/(1-pow((1+$monthlyRate), -12))) * $bond);
                $blackPublicPrice           = round($promotionPublicPrice*((100-$productList['percentage_credit_card_black'])/100)*((100-$productList['percentage_credit_card_black'])/100));
                $blackBondPrice             = round(($promotionPublicPrice*$optionalIncrement*$optionalIncrement)*($monthlyRate/(1-pow((1+$monthlyRate), -12))) * $bond);
            }else{
                $promotionPublicPrice       = round((($product['iva_cost']-$proteccionVat)+$priceGiveAway)/((100-$productList['public_price_percentage'])/100)/0.95);
                $traditionalCreditPrice     = round(($promotionPublicPrice*1)*($monthlyRate/(1-pow((1+$monthlyRate), -12))));
                $traditionalCreditBondPrice = round($traditionalCreditPrice * (1-($productList['bond_traditional']/100)));
                $bluePublicPrice            = round($promotionPublicPrice*((100-$productList['percentage_credit_card_blue'])/100));
                $blueBondPrice              = round(($promotionPublicPrice*(1-($productList['bond_blue']/100)))*($monthlyRate/(1-pow((1+$monthlyRate), -12))) * $bond);
                $blackPublicPrice           = round($promotionPublicPrice*((100-$productList['percentage_credit_card_black'])/100)*((100-$productList['percentage_credit_card_black'])/100));
                $blackBondPrice             = round(($promotionPublicPrice*$optionalIncrement*$optionalIncrement)*($monthlyRate/(1-pow((1+$monthlyRate), -12))) * $bond);
            }

            $dataProduct[$productList['name']]=[
                'normal_public_price'           => $normalPublicPrice,
                'cash_promotion'                => $cashPromotion,
                'promotion_public_price'        => $promotionPublicPrice,
                'traditional_credit_price'      => $traditionalCreditPrice*12,
                'traditional_credit_bond_price' => $traditionalCreditBondPrice*12,
                'blue_public_price'             => $bluePublicPrice,
                'blue_bond_price'               => $blueBondPrice*12,
                'black_public_price'            => $blackPublicPrice,
                'black_bond_price'              => $blackBondPrice*12,
            ];
        }

        return $dataProduct;

    }
}

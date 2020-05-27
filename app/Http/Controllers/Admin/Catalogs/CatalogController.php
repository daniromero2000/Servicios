<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Entities\Catalogs\Catalog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entities\Products\Product;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;

class CatalogController extends Controller
{
    use ProductTransformable;
    private $productRepo, $brandRepo;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BrandRepositoryInterface $brandRepository,
        ProductListRepositoryInterface $productListRepositoryInterface,
        ListProductRepositoryInterface $listProductRepositoryInterface,
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->productRepo  = $productRepository;
        $this->listProductInterface = $listProductRepositoryInterface;
        $this->giveAwayInterface    = $listGiveAwayRepositoryInterface;
        $this->factorInterface      = $factorRepositoryInterface;
        $this->brandRepo    = $brandRepository;
    }

    public function index()
    {
        $list = $this->productRepo->listFrontProducts('id');

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        return view('catalogAssessors.catalog', [
            'products' => $products,
            'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
            'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')
        ]);
    }

    public function show($slug)
    {
        $dataProduct = $this->productRepo->findProductBySlug($slug);
        $productListSku = $this->listProductInterface->findListProductBySku($dataProduct->sku);
        $product_id = $productListSku[0]->id;

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
        $monthlyRate = ($factors[0]['value'] / 100);
        $bond = 1 - ($factors[1]['value'] / 100);
        $optionalIncrement = 1 - ($factors[2]['value'] / 100);
        $zone = auth()->user()->Assessor->subsidiary->ZONA;
        foreach ($currentProductLists as $key => $productList) {
            if ($productList['zone'] == $zone) {
                $normalPublicPrice = round(($product['iva_cost'] + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / 0.95);
                $cashPromotion     = round($product['iva_cost'] / ((100 - $productList['cash_margin']) / 100));
                if ($productList['zone'] == $zone) {
                    $promotionPublicPrice       = $cashPromotion;
                    $traditionalCreditPrice     = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                    $traditionalCreditBondPrice = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                    $bluePublicPrice            = round($promotionPublicPrice * ((100 - $productList['percentage_credit_card_blue']) / 100));
                    $blueBondPrice              = round(($promotionPublicPrice * (1 - ($productList['bond_blue'] / 100))) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                    $blackPublicPrice           = round($promotionPublicPrice * ((100 - $productList['percentage_credit_card_black']) / 100));
                    $blackBondPrice             = round(($promotionPublicPrice * (1 - ($productList['bond_black'] / 100))) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                }
                $dataProduct[$productList['name']] = [
                    'normal_public_price'           => $normalPublicPrice,
                    'cash_promotion'                => $cashPromotion,
                    'promotion_public_price'        => $promotionPublicPrice,
                    'traditional_credit_price'      => $traditionalCreditPrice * 12,
                    'traditional_credit_bond_price' => $traditionalCreditBondPrice * 12,
                    'blue_public_price'             => $bluePublicPrice,
                    'blue_bond_price'               => $blueBondPrice * 12,
                    'black_public_price'            => $blackPublicPrice,
                    'black_bond_price'              => $blackBondPrice * 12,
                ];
            }
        }

        return $dataProduct;

        return view('catalogAssessors.product.show', [
            'product' => $this->productRepo->findProductBySlug($slug)
        ]);
    }
}
<?php

namespace App\Http\Controllers\Admin\Catalogs;

use App\Http\Controllers\Controller;
use App\Entities\Products\Product;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;

class CatalogController extends Controller
{
    use ProductTransformable;
    private $productRepo, $brandRepo, $listProduct;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BrandRepositoryInterface $brandRepository,
        ProductListRepositoryInterface $productListRepositoryInterface,
        ListProductRepositoryInterface $listProductRepositoryInterface,
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->productRepo          = $productRepository;
        $this->listProductInterface = $listProductRepositoryInterface;
        $this->giveAwayInterface    = $listGiveAwayRepositoryInterface;
        $this->factorInterface      = $factorRepositoryInterface;
        $this->brandRepo            = $brandRepository;
    }

    public function index()
    {
        $list = $this->productRepo->listFrontProducts('id');

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        foreach ($products as $key => $value) {
            $dataProduct[$key] = $this->productRepo->findProductBySlug($products[$key]->slug);
            $productCatalog[$key] = $dataProduct[$key];
            $productListSku[$key] = $this->listProductInterface->findListProductBySku($products[$key]->sku);
            $dataProduct[$key] = $this->getPriceProduct($productListSku[$key][0]->id);
            $products[$key]['price_old'] =  $dataProduct[$key][0]['normal_public_price'];
            $products[$key]['price_new'] =  $dataProduct[$key][0]['traditional_credit_price'];
            // $products[$key]['black_price'] =  $dataProduct[$key][0]['black_public_price'];
            $desc[$key] = $dataProduct[$key][0]['normal_public_price'] - (($productCatalog[$key]->discount * $dataProduct[$key][0]['normal_public_price']) / 100);
            $products[$key]['pays'] = round($desc[$key] / ($productCatalog[$key]->months * 4), 2, PHP_ROUND_HALF_UP);
            $products[$key]['desc'] = round($desc[$key], 2, PHP_ROUND_HALF_UP);
        }

        // dd($products);   

        return view('catalogAssessors.catalog', [
            'products' => $products,
            'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
            'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')
        ]);
    }

    public function show($slug)
    {
        $dataProduct = $this->productRepo->findProductBySlug($slug);
        $productCatalog = $dataProduct;
        $productListSku = $this->listProductInterface->findListProductBySku($dataProduct->sku);
        $dataProduct = $this->getPriceProduct($productListSku[0]->id);
        $desc = "";
        $pays = "";
        $desc = $dataProduct[0]['normal_public_price'] - (($productCatalog->discount * $dataProduct[0]['normal_public_price']) / 100);
        $priceNew = $dataProduct[0]['traditional_credit_price'] - (($productCatalog->discount * $dataProduct[0]['traditional_credit_price']) / 100);
        $pays = round($desc / ($productCatalog->months * 4), 2, PHP_ROUND_HALF_UP);
        $desc = round($desc, 2, PHP_ROUND_HALF_UP);
        $images = $productCatalog->images()->get(['src']);
        $imagenes = [];
        $productImages = [];
        array_push($productImages, $productCatalog->cover);
        foreach ($images as $key => $value) {
            array_push($productImages, $images[$key]->src);
        }
        foreach ($productImages as $key => $value) {
            array_push($imagenes, [$productImages[$key], $key]);
        }
        return view('catalogAssessors.product.show', [
            'product'   => $productCatalog,
            'prices'    => $dataProduct,
            'pays'      => $pays,
            'desc'      => $desc,
            'imagenes'  => $imagenes,
            'priceNew'  => $priceNew
        ]);
    }

    public function getPriceProduct($product_id)
    {
        // dd($product_id);

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
                $dataProduct[] = [
                    'normal_public_price'           => $normalPublicPrice,
                    'traditional_credit_price'      => $traditionalCreditPrice * 12
                    // 'black_public_price'            => $blackPublicPrice
                    // 'cash_promotion'                => $cashPromotion,
                    // 'promotion_public_price'        => $promotionPublicPrice,
                    // 'traditional_credit_bond_price' => $traditionalCreditBondPrice * 12,
                    // 'blue_public_price'             => $bluePublicPrice,
                    // 'blue_bond_price'               => $blueBondPrice * 12,
                    // 'black_bond_price'              => $blackBondPrice * 12,
                ];
            }
        }
        // dd($dataProduct);
        return $dataProduct;
    }
}
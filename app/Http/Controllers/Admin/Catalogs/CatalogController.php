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
            $zone = auth()->user()->Assessor->subsidiary->ZONA;
            $dataProduct[$key] = $this->listProductInterface->getPriceProductForZone($productListSku[$key][0]->id, $zone);
            foreach ($dataProduct[$key] as $key2 => $value2) {
                $productList = $value2;
            }
            $products[$key]['price_old'] =  $productList['normal_public_price'];
            $products[$key]['price_new'] =  $productList['traditional_credit_price'];
            // $products[$key]['black_price'] =  $productList['black_public_price'];
            $desc[$key] = $productList['normal_public_price'] - (($productCatalog[$key]->discount * $productList['normal_public_price']) / 100);
            $products[$key]['pays'] = round($desc[$key] / ($productCatalog[$key]->months * 4), 2, PHP_ROUND_HALF_UP);
            $products[$key]['desc'] = round($desc[$key], 2, PHP_ROUND_HALF_UP);
        }

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
        $zone = auth()->user()->Assessor->subsidiary->ZONA;
        $dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, $zone);
        foreach ($dataProduct as $key2 => $value2) {
            $productList = $value2;
        }
        $desc = "";
        $pays = "";
        $desc = $productList['normal_public_price'] - (($productCatalog->discount * $productList['normal_public_price']) / 100);
        // dd($productList);
        $priceNew = $productList['traditional_credit_price'];
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
            'prices'    => $productList,
            'pays'      => $pays,
            'desc'      => $desc,
            'imagenes'  => $imagenes,
            'priceNew'  => $priceNew
        ]);
    }
}
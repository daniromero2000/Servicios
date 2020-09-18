<?php

namespace App\Http\Controllers\Front\Catalog;

use App\Imagenes;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Products\Product;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use Illuminate\Http\Request;


class CatalogController extends Controller
{
	use ProductTransformable;
	private $subsidiaryInterface, $productRepo, $brandRepo, $listProductInterface;

	public function __construct(
		SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
		ProductRepositoryInterface $productRepository,
		BrandRepositoryInterface $brandRepository,
		ListProductRepositoryInterface $listProductRepositoryInterface

	) {
		$this->subsidiaryInterface      = $subsidiaryRepositoryInterface;
		$this->productRepo              = $productRepository;
		$this->brandRepo                = $brandRepository;
		$this->listProductInterface		= $listProductRepositoryInterface;
	}

	public function index()
	{
		$images = Imagenes::selectRaw('*')
			->where('category', '=', '1')
			->where('isSlide', '=', '1')
			->get();
		return view('oportuya.indexV2', ['images' => $images]);
	}

	public function getSubsidiaryCustomer(Request $request)
	{
		if (request()->has('city')) {
			return redirect()->route('catalogo.zona', request()->input('city'));
		}

		$cities = $this->subsidiaryInterface->getSubsidiaryForCities();
		return view('oportuya.getSubsidiary', compact('cities'));
	}

	public function catalog($zone)
	{
		$list = $this->productRepo->listFrontProducts('id');

		$products = $list->map(function (Product $item) {
			return $this->transformProduct($item);
		})->all();

		foreach ($products as $key => $value) {
			$dataProduct[$key]     = $this->productRepo->findProductBySlug($products[$key]->slug);
			$productCatalog[$key]  = $dataProduct[$key];
			$productListSku[$key]  = $this->listProductInterface->findListProductBySku($products[$key]->sku);
			if (!empty($productListSku[$key]->toArray())) {
				$dataProduct[$key] = $this->listProductInterface->getPriceProductForZone($productListSku[$key][0]->id, $zone);
				foreach ($dataProduct[$key] as $key2 => $value2) {
					$productList   = $value2;
				}
				$products[$key]['price_old'] =  $productList['normal_public_price'];
				$products[$key]['price_new'] =  $productList['black_public_price'];
				$products[$key]['discount']  =  round($productList['percentage_black_public_price'], 0, PHP_ROUND_HALF_UP);
				$products[$key]['pays']      =  round($products[$key]['price_new'] / ($productCatalog[$key]->months * 4), 2, PHP_ROUND_HALF_UP);
			}
		}
		return view('oportuya.catalog', [
			'products' => $products,
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
			'brands'   => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
			'zone'     => $zone
		]);
	}

	public function product($slug, $zone)
	{
		$dataProduct 	= $this->productRepo->findProductBySlug($slug);
		$productCatalog = $dataProduct;
		$productListSku = $this->listProductInterface->findListProductBySku($dataProduct->sku);

		if (!empty($productListSku->toArray())) {
			$dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, $zone);
			foreach ($dataProduct as $key2 => $value2) {
				$productList = $value2;
			}
			$productCatalog['price_old'] =  $productList['normal_public_price'];
			$productCatalog['price_new'] =  $productList['black_public_price'];
			$productCatalog['discount']  =  round($productList['percentage_black_public_price'], 0, PHP_ROUND_HALF_UP);
			$productCatalog['pays']      =  round($productCatalog['price_new'] / ($productCatalog->months * 4), 2, PHP_ROUND_HALF_UP);
		}

		$images 		= $productCatalog->images()->get(['src']);
		$imagenes 		= [];
		$productImages 	= [];

		array_push($productImages, $productCatalog->cover);
		foreach ($images as $key => $value) {
			array_push($productImages, $value->src);
		}
		foreach ($productImages as $key => $imagesProduct) {
			array_push($imagenes, [$imagesProduct, $key]);
		}

		return view('oportuya.product.show', [
			'product'   => $productCatalog,
			'imagenes'  => $imagenes,
		]);
	}
}
<?php

namespace App\Http\Controllers\Front\Catalog;

use App\Imagenes;
use App\Http\Controllers\Controller;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\FactorsOportudata\Repositories\Interfaces\FactorsOportudataRepositoryInterface;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Products\Product;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use Illuminate\Http\Request;


class CatalogController extends Controller
{
	use ProductTransformable;
	private $subsidiaryInterface, $productRepo, $brandRepo, $listProductInterface, $factorInterface;

	public function __construct(
		SubsidiaryRepositoryInterface $subsidiaryRepositoryInterface,
		ProductRepositoryInterface $productRepository,
		BrandRepositoryInterface $brandRepository,
		ListProductRepositoryInterface $listProductRepositoryInterface,
		FactorsOportudataRepositoryInterface $FactorsOportudataRepositoryInterface

	) {
		$this->subsidiaryInterface      = $subsidiaryRepositoryInterface;
		$this->productRepo              = $productRepository;
		$this->brandRepo                = $brandRepository;
		$this->listProductInterface		= $listProductRepositoryInterface;
		$this->factorInterface 			= $FactorsOportudataRepositoryInterface;
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

			$semana[$key] = $productCatalog[$key]->months / 4;
			$factor[$key] = $this->factorInterface->findFactorsOportudata($productCatalog[$key]->months);
			$pays[$key] = $factor[$key]->FACTOR / $semana[$key];


			if (!empty($productListSku[$key]->toArray())) {
				$dataProduct[$key] = $this->listProductInterface->getPriceProductForZone($productListSku[$key][0]->id, $zone);
				foreach ($dataProduct[$key] as $key2 => $value2) {
					$productList   = $value2;
				}
				$products[$key]['price_old'] =  $productList['normal_public_price'];
				$products[$key]['price_new'] =  round($productList['black_public_price'], -1, PHP_ROUND_HALF_UP);
				$products[$key]['discount']  =  round($productList['percentage_black_public_price'], -1, PHP_ROUND_HALF_UP);
				$products[$key]['pays'] 	 =  round($products[$key]['price_new'] * $pays[$key], -1, PHP_ROUND_HALF_UP);
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
		$semana = $productCatalog->months / 4;
		$factor = $this->factorInterface->findFactorsOportudata($productCatalog->months);
		$pays = $factor->FACTOR / $semana;

		if (!empty($productListSku->toArray())) {
			$dataProduct     = $this->listProductInterface->getPriceProductForZone($productListSku[0]->id, $zone);
			foreach ($dataProduct as $key2 => $value2) {
				$productList = $value2;
			}
			$productCatalog['price_old'] = $productList['normal_public_price'];
			$productCatalog['price_new'] = round($productList['black_public_price'], -1, PHP_ROUND_HALF_UP);
			$productCatalog['discount']  = round($productList['percentage_black_public_price'], -1, PHP_ROUND_HALF_UP);
			$productCatalog['pays'] 	 = round(($productCatalog['price_new'] * $pays ), -1,
			PHP_ROUND_HALF_UP);
		}

		$images = $productCatalog->images()->get(['src']);
		$imagenes = [];
		$productImages =[];

		array_push($productImages, $productCatalog->cover);
		foreach ( $images as $key => $value) {
		array_push($productImages, $images[$key]->src );

		}
		foreach ( $productImages as $key => $value) {
		array_push($imagenes, [$productImages[$key], $key]);
		}

		return view('oportuya.product.show', [
			'product'   => $productCatalog,
			'imagenes'  => $imagenes,
		]);
	}
}
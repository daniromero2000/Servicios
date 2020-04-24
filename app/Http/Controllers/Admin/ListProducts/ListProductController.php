<?php

namespace App\Http\Controllers\Admin\ListProducts;

use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ListProductController extends Controller
{
    private $productListInterface;
    private $listProductInterface;

    public function __construct(
        ListProductRepositoryInterface $listProductRepositoryInterface,
        ProductListRepositoryInterface $productListRepositoryInterface
        ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->listProductInterface = $listProductRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $listProducts = $this->listProductInterface->getAlllistProducts();
        return response()->json($listProducts);
    }

    public function store(Request $request)
    {
        // dd($request->input());
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
        $costObs = "154700";
        foreach ($currentProductLists as $key => $productList) {
            $dataProduct[$productList['name']]=[
                'normal_public_price' => round(($product['iva_cost']+$costObs)/((100-$productList['public_price_percentage'])/100)/0.95)
            ];
        }

        return $dataProduct;

    }
}

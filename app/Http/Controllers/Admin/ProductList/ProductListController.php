<?php

namespace App\Http\Controllers\Admin\ProductList;

use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Profiles;


class ProductListController extends Controller
{
    private $productListInterface;

    public function __construct(
        ProductListRepositoryInterface $productListRepositoryInterface
    ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $productLists = $this->productListInterface->getAllProductLists();

        return response()->json($productLists);
    }

    public function store(Request $request)
    {
        $data = $request->input();
        $data['creation_user_id'] = auth()->user()->id;
        $productList =  $this->productListInterface->createProductList($data);
        // dd($data);
        return $productList;
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        $productList =  $this->productListInterface->updateProductList($data);

        return response()->json($productList);
    }

    public function destroy($id)
    {
        $productList =  $this->productListInterface->deleteProductList($id);
        return response()->json($productList);
    }

    public function getDataPriceProduct($productId)
    {
    }
}
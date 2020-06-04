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
        return $productList;
    }

    public function show($id){
        $subsidiariesReturn = [];

        $productList = $this->productListInterface->findProductListById($id);

        $subsidiaries = $productList->sudsidiaries;

        foreach ($subsidiaries as $subsidiary){
            $subsidiariesReturn[] = ['text' => $subsidiary['CODIGO']];
        }

        return $subsidiariesReturn;
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

    public function addSubsidiariesToProductList(Request $request, $id){
        DB::table('product_list_subsidiary')->where('product_list_id', $id)->delete();
        $productList = $this->productListInterface->findProductListById($id);
        foreach ($request->input() as $subsidiary) {
            $productList->sudsidiaries()->attach($subsidiary['text']);
        }

        return "true";
    }
}
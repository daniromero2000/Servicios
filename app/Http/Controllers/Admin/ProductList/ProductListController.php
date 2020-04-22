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
        // dd($request->input());
        $data = $request->input();
        $data['creation_user_id'] = auth()->user()->id;
        dd($data);

        $productList =  $this->productListInterface->createProductList($data);
        dd($productList);
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
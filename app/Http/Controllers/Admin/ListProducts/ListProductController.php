<?php

namespace App\Http\Controllers\Admin\ListProducts;

use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ListProductController extends Controller
{

    private $listProductInterface;

    public function __construct(
        ListProductRepositoryInterface $listProductRepositoryInterface
    ) {
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
}

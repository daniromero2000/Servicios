<?php

namespace App\Http\Controllers\Admin\ListProducts;

use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\ListProducts\ListProduct;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListProductController extends Controller
{
    private $productListInterface;
    private $listProductInterface;
    private $giveAwayInterface;
    private $factorInterface;

    public function __construct(
        ListProductRepositoryInterface $listProductRepositoryInterface,
        ProductListRepositoryInterface $productListRepositoryInterface,
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->productListInterface = $productListRepositoryInterface;
        $this->listProductInterface = $listProductRepositoryInterface;
        $this->giveAwayInterface    = $listGiveAwayRepositoryInterface;
        $this->factorInterface      = $factorRepositoryInterface;
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $listProducts = $this->listProductInterface->getAlllistProducts();
        return response()->json($listProducts);
    }

    public function store(Request $request)
    {
        if ($request->type == 'massive') {
            DB::table('list_products')->truncate();
            $handle = fopen($request->file('listProduct'), "r") or die("Unable to open file!");
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                if ($data[0] != 'CODIGO' && $data[1] != 'NOMBRE') {
                    $product = ['sku' => $data[0], 'item' => $data[1], 'base_cost' => $data[2], 'iva_cost' => $data[3], 'cash_cost' => $data[4],'protection' => $data[5], 'min_tolerance' => $data[6], 'max_tolerance' => $data[7]];
                    $listProduct =  $this->listProductInterface->createlistProduct($product);
                }
            }
            return response()->json($listProduct);
        } else {
            $data = $request->input();

            $listProduct =  $this->listProductInterface->createlistProduct($data);

            return response()->json($listProduct);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->input();

        $listProduct =  $this->listProductInterface->updateListProduct($data);

        return response()->json($listProduct);
    }

    public function destroy($id)
    {
        $listProduct =  $this->listProductInterface->deleteListProduct($id);

        return response()->json($listProduct);
    }

    public function getDataPriceProduct($product_id)
    {
        $prices = ['normal_public_price', 'cash_promotion'];

        return $this->listProductInterface->getPriceProductForZoneEspecifiedPrices($product_id, 'BAJA', $prices);
    }
}
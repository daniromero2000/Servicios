<?php

namespace App\Entities\ProductLists\Repositories;

use App\Entities\ProductLists\ProductList;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class ProductListRepository implements ProductListRepositoryInterface
{
    private $columns = [
        'creation_user_id',
        'name',
        'public_price_percentage',
        'cash_margin',
        'checked',
        'checked_user_id',
        'start_date',
        'end_date',
        'zone',
        'bond_traditional',
        'percentage_credit_card_blue',
        'bond_blue',
        'percentage_credit_card_black',
        'bond_black',
        'apply_protection'
    ];

    public function __construct(
        ProductList $productList
    ) {
        $this->model = $productList;
    }

    public function createProductList($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllProductLists()
    {
        try {
            return $this->model->with('userChecked')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findProductListById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateProductList($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteProductList($id)
    {
        $data = $this->findProductListById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

    public function getAllCurrentProductLists()
    {
        $dateNow = date("Y-m-d");
        try {
            return $this->model->where('start_date', '<=', $dateNow)->where('end_date', '>=', $dateNow)->where('checked', 1)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getCurrentProductListsForZone($zone)
    {
        $dateNow = date("Y-m-d");
        try {
            return $this->model->where('start_date', '<=', $dateNow)->where('end_date', '>=', $dateNow)->where('checked', 1)->where('zone', $zone)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
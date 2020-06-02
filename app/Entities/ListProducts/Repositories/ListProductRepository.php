<?php

namespace App\Entities\ListProducts\Repositories;

use App\Entities\ListProducts\ListProduct;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use Illuminate\Database\QueryException;

class ListProductRepository implements ListProductRepositoryInterface
{
    private $columns = [
        'sku',
        'item',
        'base_cost',
        'iva_cost',
        'protection',
        'min_tolerance',
        'max_tolerance',
    ];

    public function __construct(
        ListProduct $ListProduct
    ) {
        $this->model = $ListProduct;
    }


    public function createListProduct($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllListProducts()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListProductById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListProductBySku($sku)
    {
        try {
            return $this->model->where('sku', $sku)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateListProduct($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteListProduct($id)
    {
        $data = $this->findListProductById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }
}
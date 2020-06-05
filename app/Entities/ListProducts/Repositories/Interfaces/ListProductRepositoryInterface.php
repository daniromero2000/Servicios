<?php

namespace App\Entities\ListProducts\Repositories\Interfaces;

interface ListProductRepositoryInterface
{
    public function createListProduct($data);

    public function getAllListProducts();

    public function findListProductById($id);

    public function updateListProduct($data);

    public function deleteListProduct($id);

    public function findListProductBySku($sku);
}
<?php

namespace App\Entities\ProductLists\Repositories\Interfaces;

interface ProductListRepositoryInterface
{
    public function createProductList($data);

    public function getAllProductLists();

    public function findProductListById($id);

    public function updateProductList($data);

    public function deleteProductList($id);

    public function getAllCurrentProductLists();

    public function getCurrentProductListsForZone($zone);

    public function getProductListsForTheCatalog($zone);
}
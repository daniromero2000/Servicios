<?php

namespace App\Entities\ListProducts\Repositories\Interfaces;

interface ListProductRepositoryInterface
{
    public function createListProduct($data);

    public function getAllListProducts();

    public function findListProductById($id);

    public function findListProductBySku($sku);

    public function updateListProduct($data);

    public function deleteListProduct($id);

    public function getPriceProductForAllCurrentList($product_id);

    public function getPriceProductForAllCurrentListEspecifiedPrices($product_id, $prices = []);

    public function getPriceProductForZone($product_id, $zone);

    public function getPriceProductForZoneEspecifiedPrices($product_id, $zone, $prices = []);

    public function getPriceProductForCatalogo($product_id, $zone);
}
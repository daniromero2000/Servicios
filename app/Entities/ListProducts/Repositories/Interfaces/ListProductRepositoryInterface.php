<?php

namespace App\Entities\ListProducts\Repositories\Interfaces;

interface ListProductRepositoryInterface
{
    public function createListProduct($data);

    public function getAllListProducts();

    public function findListProductById($id);

    public function updateListProduct($data);

    public function deleteListProduct($id);

<<<<<<< HEAD
    public function findListProductBySku($sku);
=======
    public function getPriceProductForAllCurrentList($product_id);

    public function getPriceProductForAllCurrentListEspecifiedPrices($product_id, $prices=[]);

    public function getPriceProductForZone($product_id, $zone);

    public function getPriceProductForZoneEspecifiedPrices($product_id, $zone, $prices = []);
>>>>>>> 2807f8870ec76370f84a241f431e8464d683fdae
}
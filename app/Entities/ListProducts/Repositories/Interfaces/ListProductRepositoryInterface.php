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

<<<<<<< HEAD
<<<<<<< HEAD
    public function findListProductBySku($sku);
=======
=======
>>>>>>> e0b9b72037d270bde3fe017da725cfc68b793823
    public function getPriceProductForAllCurrentList($product_id);

    public function getPriceProductForAllCurrentListEspecifiedPrices($product_id, $prices = []);

    public function getPriceProductForZone($product_id, $zone);

    public function getPriceProductForZoneEspecifiedPrices($product_id, $zone, $prices = []);
<<<<<<< HEAD
>>>>>>> 2807f8870ec76370f84a241f431e8464d683fdae
=======
>>>>>>> e0b9b72037d270bde3fe017da725cfc68b793823
}
<?php

namespace App\Entities\ListProducts\Repositories;

use App\Entities\ListProducts\ListProduct;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use Illuminate\Database\QueryException;

class ListProductRepository implements ListProductRepositoryInterface
{
    public function __construct(
        ListProduct $ListProduct
    ) {
        $this->model = $ListProduct;
    }
}

<?php

namespace App\Entities\ProductImages;

use App\Entities\Products\Product;

class ProductImageRepository
{
    /**
     * ProductImageRepository constructor.
     * @param ProductImage $productImage
     */
    public function __construct(ProductImage $productImage)
    {
        $this->model = $productImage;
    }

    /**
     * @return mixed
     */
    public function findProduct(): Product
    {
        return $this->model->product;
    }
}

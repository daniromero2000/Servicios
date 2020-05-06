<?php

namespace App\Entities\Products\Transformations;

use App\Entities\Products\Product;
use Illuminate\Support\Facades\Storage;
use App\Entities\ProductStatuses\ProductStatus;
use App\Entities\ProductStatuses\Repositories\ProductStatusRepository;
use App\Entities\Brands\Brand;
use App\Entities\Brands\Repositories\BrandRepository;

trait ProductTransformable
{
    protected function transformProduct(Product $product)
    {
        $prod = new Product;
        $prod->id = (int) $product->id;
        $prod->reference = $product->reference;
        $prod->name = $product->name;
        $prod->sku = $product->sku;
        $prod->slug = $product->slug;
        $prod->description = $product->description;
        $prod->cover = $product->cover;
        $prod->description_image1 = $product->description_image1;
        $prod->description_image2 = $product->description_image2;
        $prod->description_image3 = $product->description_image3;
        $prod->description_image4 = $product->description_image4;
        $prod->specification_image = $product->specification_image;
        $prod->quantity = $product->quantity;
        $prod->price = $product->price;
        $prod->status = $product->status;
        $prod->months = $product->months;
        $prod->pays = $product->pays;
        $prod->sale_price = $product->sale_price;
        $brandsRepo = new BrandRepository(new Brand());
        $prod->brand_id = $brandsRepo->findBrandById($product->brand_id);
        return $prod;
    }
}
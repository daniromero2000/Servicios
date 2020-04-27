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
    /**
     * Transform the product
     *
     * @param Product $product
     * @return Product
     */
    protected function transformProduct(Product $product)
    {
        $prod = new Product;
        $prod->id = (int) $product->id;
        $prod->name = $product->name;
        $prod->sku = $product->sku;
        $prod->slug = $product->slug;
        $prod->description = $product->description;
        $prod->cover = $product->cover;
        $prod->quantity = $product->quantity;
        $prod->price = $product->price;
        $productStatusRepo = new ProductStatusRepository(new ProductStatus());
        $prod->product_status_id = $productStatusRepo->findProductStatusById($product->product_status_id);
        $prod->status = $product->status;
        $prod->weight = (float) $product->weight;
        $prod->mass_unit = $product->mass_unit;
        $prod->sale_price = $product->sale_price;
        $brandsRepo = new BrandRepository(new Brand());
        $prod->brands_id = $brandsRepo->findBrandById($product->brands_id);
        // $prod->brands_id = (int) $product->brands_id;

        return $prod;
    }
}
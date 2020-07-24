<?php

namespace App\Entities\Products;

use App\Entities\Brands\Brand;
use App\Entities\ProductImages\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'products.sku' => 10,
            'products.name' => 10,
            'products.description' => 5
        ],
        'groupBy' => ['products.id']
    ];

    protected $fillable = [
        'sku',
        'name',
        'description',
        'reference',
        'cover',
        'description_image1',
        'description_image2',
        'description_image3',
        'description_image4',
        'specification_image',
        'brand_id',
        'status',
        'months',
        'status',
        'slug'
    ];

    protected $hidden = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function searchProduct(string $term): Collection
    {
        return self::search($term)->get();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
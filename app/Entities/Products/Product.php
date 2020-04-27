<?php

namespace App\Entities\Products;

use App\Entities\Brands\Brand;
use App\Entities\Categories\Category;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\ProductAttributes\ProductAttribute;
use App\Entities\ProductImages\ProductImage;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model implements Buyable
{
    use SearchableTrait;

    public const MASS_UNIT = [
        'OUNCES' => 'oz',
        'GRAMS' => 'gms',
        'POUNDS' => 'lbs'
    ];

    public const DISTANCE_UNIT = [
        'CENTIMETER' => 'cm',
        'METER' => 'mtr',
        'INCH' => 'in',
        'MILIMETER' => 'mm',
        'FOOT' => 'ft',
        'YARD' => 'yd'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'products.sku' => 10,
            'products.name' => 10,
            'product_statuses.name' => 10,
            'products.description' => 5
        ],
        'joins' => [
            'product_statuses' => ['product_statuses.id', 'products.product_status_id']
        ],
        'groupBy' => ['products.id']
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'description',
        'cover',
        'quantity',
        'price',
        'brands_id',
        'product_status_id',
        'status',
        'weight',
        'mass_unit',
        'status',
        'sale_price',
        'length',
        'width',
        'height',
        'distance_unit',
        'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subsidiaries()
    {
        return $this->belongsToMany(Subsidiary::class);
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @param null $options
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @param null $options
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @param null $options
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        return $this->price;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @param string $term
     * @return Collection
     */
    public function searchProduct(string $term) : Collection
    {
        return self::search($term)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}

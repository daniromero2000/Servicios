<?php

namespace App\Entities\ListProducts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'item',
        'base_cost',
        'iva_cost',
        'cash_cost',
        'protection',
        'min_tolerance',
        'max_tolerance',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
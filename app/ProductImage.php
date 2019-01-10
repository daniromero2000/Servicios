<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    
	protected $dates = ['deleted_at'];

    protected $table = 'product_images';

    protected $fillable = ['id','name','order','idProduct'];
}

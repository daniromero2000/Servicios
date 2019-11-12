<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotosBrands extends Model
{
    protected $table = 'motos_brands';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'brand'
    ];
}

<?php

namespace App\Entities\FactoryRequestProducts;

use Illuminate\Database\Eloquent\Model;

class FactoryRequestProduct extends Model
{
    protected $table = 'SUPER';

    protected $connection = 'oportudata';

    protected $fillable = [];
}

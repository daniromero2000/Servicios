<?php

namespace App\Entities\Cities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'CIUDADES';

    protected $connection = 'oportudata';

    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CiudadesSoc extends Model
{
    protected $table = 'ciudades_soc';

    protected $fillable = [
        'office',
        'address',
        'city',
        'state',
        'responsable',
        'phone'
    ];
}

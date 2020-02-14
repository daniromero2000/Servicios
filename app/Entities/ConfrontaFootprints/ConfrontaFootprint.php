<?php

namespace App\Entities\ConfrontaFootprints;

use App\Entities\ConfrontaResults\ConfrontaResult;
use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class ConfrontaFootprint extends Model
{
    protected $table = 'confronta_huella';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'consec',
        'cedula',
        'fechaconsulta',
        'entidad',
        'resultado'
    ];
}
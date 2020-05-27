<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Assessor extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'ASESORES';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CODIGO';

    protected $fillable = [
        'CODIGO',
        'NUM_COD',
        'NOMBRE',
        'SUCURSAL',
        'STATE'
    ];
}
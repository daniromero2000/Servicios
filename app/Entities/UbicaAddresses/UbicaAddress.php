<?php

namespace App\Entities\UbicaAddresses;

use App\Entities\Ubicas\Ubica;
use Illuminate\Database\Eloquent\Model;

class UbicaAddress extends Model
{
    protected $table = 'ubica_direccion';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ubiconsul';

    public $timestamps = false;

    protected $fillable = [
        'ubiconsul',
        'ubiposicion',
        ''
    ];
}
<?php

namespace App\Entities\CustomerReferences;

use Illuminate\Database\Eloquent\Model;

class CustomerReference extends Model
{
    protected $table = 'DATOS_CLIENTE';

    protected $connection = 'oportudata';

    protected $primaryKey =  'SOLICITUD';

    public $timestamps = false;
}

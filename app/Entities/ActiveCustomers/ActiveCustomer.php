<?php

namespace App\Entities\ActiveCustomers;

use Illuminate\Database\Eloquent\Model;

class ActiveCustomer extends Model
{
    protected $table = 'TB_CLIENTES_ACTIVOS';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    protected $fillable = [
        'CEDULA',
        'FECHA',
        'ESTADO',

    ];
}

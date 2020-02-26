<?php

namespace App\Entities\DebtorInsurances;

use Illuminate\Database\Eloquent\Model;

class DebtorInsurance extends Model
{
    protected $table = 'SEG_DEUDORES';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    protected $fillable = [
        'CEDULA',
        'VRCREDITO',
        'CIA',
        'SOLIC',
        'SUCURSAL',
        'FECHA',
        'VALOR',
        'BENEFIC',
        'PARENTESCO',
        'SEG_VAL',
        'STATE',
        'CEDULA_BEN',
    ];
}
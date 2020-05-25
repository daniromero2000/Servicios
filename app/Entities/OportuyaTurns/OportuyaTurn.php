<?php

namespace App\Entities\OportuyaTurns;

use Illuminate\Database\Eloquent\Model;

class OportuyaTurn extends Model
{
    protected $table = 'TURNOS_OPORTUYA';

    protected $primaryKey = 'NUMERO';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'SOLICITUD',
        'CEDULA',
        'FECHA',
        'SUC',
        'USUARIO',
        'PRIORIDAD',
        'ESTADO',
        'TIPO',
        'SUB_TIPO',
        'FEC_RET',
        'FEC_FIN',
        'VALOR',
        'FEC_ASIG',
        'SCORE',
        'TIPO_CLI',
        'CED_COD1',
        'SCO_COD1',
        'TIPO_COD1',
        'CED_COD2',
        'SCO_COD2',
        'TIPO_COD2',
        'STATE'
    ];
}

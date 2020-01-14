<?php

namespace App\Entities\Warranties;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'GARANTIAS';

    protected $connection = 'oportudata';

    protected $primaryKey = 'NUMERO';

    protected $fillable = [
        'NUMERO',
        'CEDULA',
        'NOM_CLIENT',
        'COD_SUC',
        'NOM_SUC',
        'FACTURA',
        'FECHAFAC',
        'VALOR',
        'TIPO_FAC',
        'N_ENTRADA',
        'COD_ARTIC',
        'NOM_ARTIC',
        'MARCA',
        'NSEVICIO',
        'GRUPO',
        'SERIAL',
        'IMEI',
        'DIAGNOSTIC',
        'NOM_TALLER',
        'OBSERVAC',
        'INVENTARIO',
        'UBICACION',
        'SOLUCION',
        'FEC_LLEGA',
        'FEC_SALIDA',
        'FEC_SOL',
        'FEC_ENTREG',
        'USUARIO',
        'ANULA',
        'USU_SOL',
        'CIERRE',
        'CALIFICA',
        'BONO',
        'ESTADO',
        'STATE',
        'TOT_FAC',
        'PRODUCT_USER',
        'RELACION'
    ];

    public $timestamps = false;
}

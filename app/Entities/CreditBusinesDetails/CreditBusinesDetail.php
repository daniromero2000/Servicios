<?php

namespace App\Entities\CreditBusinesDetails;

use Illuminate\Database\Eloquent\Model;

class CreditBusinesDetail extends Model
{
    protected $table = 'SUPER_2';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'SOLICITUD',
        'CONSEC',
        'CONSEC2',
        'COD_PROCESO',
        'CANTIDAD',
        'LISTA',
        'COD_ARTIC',
        'SELECCION',
        'ARTICULO',
        'PRECIO_P',
    ];
}
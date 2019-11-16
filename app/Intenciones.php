<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intenciones extends Model
{
    protected $table = 'TB_INTENCIONES';

    protected $connection = 'oportudata';

    protected $fillable = [
        'CEDULA',
        'ID_DEF',
        'TIPO_CLIENTE',
        'PERFIL_CREDITICIO',
        'HISTORIAL_CREDITO',
        'TARJETA',
        'ZONA_RIESGO',
        'EDAD',
        'TIEMPO_LABOR',
        'TIPO_5_ESPECIAL',
        'INSPECCION_OCULAR',
        'ESTADO_OBLIGACIONES'
    ];

    public $timestamps = false;
}

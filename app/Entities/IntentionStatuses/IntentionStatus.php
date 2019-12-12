<?php

namespace App\Entities\IntentionStatuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class IntentionStatus extends Model
{


    protected $table = 'ESTADOSOLICITUDES';

    protected $connection = 'oportudata';

    protected $primaryKey =  'ID';

    public $timestamps = false;

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

    protected $searchable = [
        'columns' => [
            'TB_INTENCIONES.CEDULA'   => 1,
        ],
    ];

    public function searchIntentionsStatuss($term)
    {
        return self::search($term);
    }
}

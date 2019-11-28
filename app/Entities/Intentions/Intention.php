<?php

namespace App\Entities\Intentions;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Definitions\Definition;
use Nicolaslopezj\Searchable\SearchableTrait;

class Intention extends Model
{
    use SearchableTrait;

    protected $table = 'TB_INTENCIONES';

    protected $connection = 'oportudata';

    protected $primaryKey =  'id';

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

    public function searchIntentions($term)
    {
        return self::search($term);
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class, 'ID_DEF');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CEDULA');
    }
}

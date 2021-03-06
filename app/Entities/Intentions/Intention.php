<?php

namespace App\Entities\Intentions;

use App\Entities\Customers\Customer;
use App\Entities\DataIntentionsRequest\DataIntentionsRequest;
use Illuminate\Database\Eloquent\Model;
use App\Entities\Definitions\Definition;
use App\Entities\IntentionStatuses\IntentionStatus;
use Illuminate\Auth\Authenticatable;
use App\Entities\Assessors\Assessor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Support\Facades\DB;

class Intention extends Model
{
    use Authenticatable, SearchableTrait, SoftDeletes;

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
        'ESTADO_OBLIGACIONES',
        'ESTADO_INTENCION',
        'CREDIT_DECISION',
        'ASESOR',
        'FECHA_INTENCION',
        'product_id',
        'deleted_at'
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

    public function exportIntentions($term)
    {
        return self::search($term);
    }

    public function searchIntentionAssessors($term)
    {
        return self::search($term);
    }

    public function searchIntentionDirector($term)
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

    public function assessor()
    {
        return $this->belongsTo(Assessor::class, 'ASESOR');
    }

    public function intentionStatus()
    {
        return $this->belongsTo(IntentionStatus::class, 'ESTADO_INTENCION');
    }

    public function dataIntentionRequest()
    {
        return $this->hasMany(DataIntentionsRequest::class);
    }
}

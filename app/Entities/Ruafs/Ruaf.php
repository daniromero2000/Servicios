<?php

namespace App\Entities\Ruafs;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruaf extends Model
{
    use SoftDeletes;
    protected $table = 'fosyga_ruaf';

    protected $connection = 'oportudata';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'cedula',
        'nombres',
        'regimen_salud',
        'administradora_salud',
        'estado_salud',
        'tipo_afiliado_salud',
        'ciudad_afiliacion',
        'regimen_pension',
        'administradora_pension',
        'estado_pension',
        'tipo_afiliacion_compensacion_familiar',
        'administradora_compensacion_familiar',
        'estado_compensacion_familiar',
        'fuenteFallo'
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}
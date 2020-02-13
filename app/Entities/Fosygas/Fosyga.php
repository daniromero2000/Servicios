<?php

namespace App\Entities\Fosygas;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class Fosyga extends Model
{
    protected $table = 'fosyga_bdua';

    protected $connection = 'oportudata';

    protected $primaryKey = 'idBdua';

    public $timestamps = false;

    protected $fillable = [
        'idBdua',
        'idConsulta',
        'cedula',
        'tipoDocumento',
        'pais',
        'primerNombre',
        'primerApellido',
        'tipoNombre',
        'estado',
        'entidad',
        'regimen',
        'fechaAfiliacion',
        'fechaFinalAfiliacion',
        'departamento',
        'ciudad',
        'tipoAfiliado',
        'fechaConsulta',
        'fuenteFallo'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}
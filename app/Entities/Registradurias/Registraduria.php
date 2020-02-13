<?php

namespace App\Entities\Registradurias;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class Registraduria extends Model
{
    protected $table = 'fosyga_estadoCedula';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $primaryKey = 'idEstadoCedula';

    protected $fillable = [
        'idEstadoCedula',
        'idConsulta',
        'cedula',
        'tipoDocumento',
        'pais',
        'primerNombre',
        'tipoNombre',
        'fechaExpedicion',
        'lugarExpedicion',
        'estado',
        'resolucion',
        'fechaResolucion',
        'fechaConsulta',
        'fuenteFallo'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCedula extends Model
{
    protected $table = 'fosyga_estadoCedula';

    protected $connection = 'oportudata';

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

    public $timestamps = false;
}

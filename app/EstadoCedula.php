<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCedula extends Model
{
    public $table = 'fosyga_estadoCedula';

    public $connection = 'oportudata';

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

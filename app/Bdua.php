<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bdua extends Model
{
    public $table = 'fosyga_bdua';

    public $connection = 'oportudata';

    protected $primaryKey = 'idBdua';

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

    public $timestamps = false;
}

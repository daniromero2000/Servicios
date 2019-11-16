<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaEmpleados extends Model
{
    protected $table = 'LISTA_EMPLEADOS';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    public $timestamps = false;

    protected $fillable = [
        'identificador',
        'num_documento',
        'nombre',
        'estado'
    ];
}

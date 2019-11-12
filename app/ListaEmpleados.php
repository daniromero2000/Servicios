<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaEmpleados extends Model
{
    public $table = 'LISTA_EMPLEADOS';

    public $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    public $timestamps = false;

    protected $fillable = [
        'identificador',
        'num_documento',
        'nombre',
        'estado'
    ];
}

<?php

namespace App\Entities\Employees;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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

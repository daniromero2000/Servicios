<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CLIENTE extends Model
{
    protected $table = 'CLIENTE';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    protected $fillable = [
        'TIPO_DOC',
        'CEDULA',
        'APELLIDOS',
        'NOMBRES',
        'DIRECCION',
        'TELEFONO',
        'NOM_CIUDAD',
        'TELEFONO2',
        'TELEFONO3',
        'BONO',
        'SUC',
        'STATE'
    ];

    public $timestamps = false;
}

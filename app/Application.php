<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Application extends Model
{
    use Authenticatable;

    protected $table = 'SOLIC_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CLIENTE';

    protected $fillable = [
        'CLIENTE',
        'CODASESOR',
        'id_asesor',
        'FECHASOL',
        'SUCURSAL',
        'ESTADO',
        'STATE',
        'FTP',
        'GRAN_TOTAL',
        'PRODUC_W',
        'AVANCE_W',
        'SOLICITUD_WEB',
        'ID_EMPRESA'
    ];

    public $timestamps = false;
}

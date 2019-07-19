<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Application extends Model
{
     use Authenticatable;

    public $table='SOLIC_FAB';

    public $connection='oportudata';

    protected $primaryKey= 'CLIENTE';

    protected $fillable=['CLIENTE','CODASESOR','id_asesor','FECHASOL','SUCURSAL','ESTADO','STATE','FTP','GRAN_TOTAL', 'PRODUC_W', 'AVANCE_W', 'SOLICITUD_WEB', 'ID_EMPRESA'];
    public $timestamps = false;

}

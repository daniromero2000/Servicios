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

    protected $fillable=['CLIENTE','CODASESOR','FECHASOL','SUCURSAL','ESTADO','STATE','FTP','GRAN_TOTAL'];
    public $timestamps = false;

}

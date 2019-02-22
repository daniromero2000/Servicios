<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliCel extends Model
{
    public $table='CLI_CEL';

    public $connection='oportudata';

    protected $primaryKey= 'CEDULA, CELULAR';

    public $timestamps = false;

    protected $fillable=['CEDULA','CELULAR','CEL_VAL','FECHA'];
}

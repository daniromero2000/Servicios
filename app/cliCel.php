<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliCel extends Model
{
    public $table='CLI_CEL';

    public $connection='oportudata';

    protected $primaryKey= 'CEDULA, NUMERO';

    public $timestamps = false;

    protected $fillable=['IDENTI','NUM','CEL_VAL','TIPO','FECHA'];
}

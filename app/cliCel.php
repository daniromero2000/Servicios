<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliCel extends Model
{
    protected $table = 'CLI_CEL';

    protected $connection = 'oportudata';

    protected $primaryKey = 'IDENTI, NUM';

    public $timestamps = false;

    protected $fillable = [
        'IDENTI',
        'NUM',
        'CEL_VAL',
        'TIPO',
        'FECHA'
    ];
}

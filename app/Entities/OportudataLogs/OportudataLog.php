<?php

namespace App\Entities\OportudataLogs;

use Illuminate\Database\Eloquent\Model;

class OportudataLog extends Model
{
    protected $table = 'log_oportudata';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificacion';

    public $timestamps = false;

    protected $fillable = [
        'modulo',
        'proceso',
        'accion',
        'identificacion',
        'fecha',
        'usuario',
        'state'
    ];
}
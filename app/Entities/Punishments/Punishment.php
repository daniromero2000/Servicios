<?php

namespace App\Entities\Punishments;

use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    protected $table = 'TB_CASTIGO';

    protected $connection = 'oportudata';

    protected $primaryKey = 'cedula';

    public $timestamps = false;

    protected $fillable = [
        'cedula',
        'usuario',
        'castigado',
        'fecha_update',
        'fecha_insert'
    ];
}

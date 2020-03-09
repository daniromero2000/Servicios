<?php

namespace App\Entities\Kinships;

use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    protected $table = 'PARENTESCO';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CODIGO';

    public $timestamps = false;

    protected $fillable = [
        'CODIGO',
        'TIPO',
        'STATE'
    ];
}
<?php

namespace App\Entities\Plans;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'PLANES';

    protected $primaryKey = 'CODIGO';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'CODIGO',
        'PLAN',
        'NOTA',
        'STATE'
    ];
}
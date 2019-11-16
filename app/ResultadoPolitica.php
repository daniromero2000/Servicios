<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoPolitica extends Model
{
    protected $table = 'TB_RESULTADO_POLITICA';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'RESULTADO'
    ];

    public $timestamps = false;
}

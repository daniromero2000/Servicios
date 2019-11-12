<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoPolitica extends Model
{
    public $table = 'TB_RESULTADO_POLITICA';

    public $connection = 'oportudata';

    protected $primaryKey = 'ID';

    protected $fillable = [
        'ID',
        'RESULTADO'
    ];

    public $timestamps = false;
}

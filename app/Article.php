<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'ARTICULOS';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CODIGO';

    protected $fillable = [
        'CODIGO',
        'NOMBRE',
        'MARCA',
        'REFERENCIA',
        'STATE'
    ];

    public $timestamps = false;
}

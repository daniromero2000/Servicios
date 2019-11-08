<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'ARTICULOS';

    public $connection = 'oportudata';

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

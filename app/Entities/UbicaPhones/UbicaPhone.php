<?php

namespace App\Entities\UbicaPhones;

use Illuminate\Database\Eloquent\Model;

class UbicaPhone extends Model
{
    protected $table = 'ubica_telefono';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ubiconsul';

    public $timestamps = false;

    protected $fillable = [
        'ubiconsul',
        'ubiposicion',
        'ubinoreporte',
        'ubiprodactivo',
        'ubitipoubi',
        'ubisector',
        'ubiprimerrep',
        'ubiultimorep',
        'ubicelular'
    ];
}

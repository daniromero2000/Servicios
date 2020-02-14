<?php

namespace App\Entities\UbicaPrincipals;

use Illuminate\Database\Eloquent\Model;

class UbicaPrincipal extends Model
{
    protected $table = 'ubica_principal';

    protected $connection = 'oportudata';

    protected $primaryKey = 'ubiconsul';

    public $timestamps = false;

    protected $fillable = [
        'ubiconsul',
        'ubicedula',
        'ubinombre',
        'ubifeccons',
        'genero'
    ];
}
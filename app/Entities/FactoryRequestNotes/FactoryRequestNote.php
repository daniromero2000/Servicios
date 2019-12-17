<?php

namespace App\Entities\FactoryRequestNotes;

use Illuminate\Database\Eloquent\Model;

class FactoryRequestNote extends Model
{
    protected $table = 'NOTAS_FAB';

    protected $connection = 'oportudata';

    protected $fillable = [
        'SOLICITUD',
        'CEDULA',
        'ETAPA',
        'DESCRIP',
        'FECHA',
        'USUARIO'
    ];
}

<?php

namespace App\Entities\CommercialConsultations;

use Illuminate\Database\Eloquent\Model;

class CommercialConsultation extends Model
{
    protected $table = 'consulta_ws';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'usuario',
        'cedula',
        'estado'
    ];
}

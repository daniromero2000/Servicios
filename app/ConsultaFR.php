<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultaFR extends Model
{
    protected $table = 'fosyga_consulta_fr';

    protected $connection = 'oportudata';

    protected $primaryKey = 'idConsulta';

    protected $fillable = [
        'idConsulta',
        'cedula'
    ];

    public $timestamps = false;
}

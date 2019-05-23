<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultaFR extends Model
{
    public $table='fosyga_consulta_fr';

    public $connection='oportudata';

    protected $primaryKey= 'idConsulta';

    protected $fillable=['idConsulta', 'cedula'];
    public $timestamps = false;

}

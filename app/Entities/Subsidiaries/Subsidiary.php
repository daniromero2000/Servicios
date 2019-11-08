<?php

namespace App\Entities\Subsidiaries;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
  public $table = 'SUCURSALES';

  public $connection = 'oportudata';

  protected $primaryKey = 'CODIGO';

  public $timestamps = false;

  protected $fillable = [
    'CODIGO',
    'NOMBRE',
    'DIRECCION',
    'TELEFONO',
    'RESPONSABLE',
    'CIUDAD',
    'ZONA',
    'PRINCIPAL',
    'STATE',
    'ALMACEN',
    'DEPARTAMENTO_ID',
  ];

  protected $guarded = [
    'CODIGO',
  ];
}

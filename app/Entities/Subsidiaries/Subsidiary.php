<?php

namespace App\Entities\Subsidiaries;

use App\Entities\FactoryRequests\FactoryRequest;
use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
  protected $table = 'SUCURSALES';

  protected $connection = 'oportudata';

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

  public function factoryRequests()
  {
    return $this->hasMany(FactoryRequest::class);
  }
}

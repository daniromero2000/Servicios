<?php

namespace App\Entities\ConfrontaWebServices;

use App\Entities\ConfrontaResults\ConfrontaResult;
use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class Confronta extends Model
{
    protected $table = 'confronta_ws';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'consec',
        'cedula',
        'idConsulta',
        'fecha',
        'nombre',
        'estadoid',
        'codigoid',
        'secuencia',
        'respuesta'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
    public function confrontaResult()
    {
        return $this->hasOne(ConfrontaResult::class, 'cedula');
    }
}
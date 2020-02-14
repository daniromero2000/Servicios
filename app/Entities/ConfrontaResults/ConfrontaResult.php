<?php

namespace App\Entities\ConfrontaResults;

use App\Entities\ConfrontaResults\Confronta;
use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class ConfrontaResult extends Model
{
    protected $table = 'confronta_result';

    protected $connection = 'oportudata';

    protected $primaryKey = 'consec';

    public $timestamps = false;

    protected $fillable = [
        'consec',
        'cedula',
        'aciertos',
        'respuesta',
        'resultado',
        'score'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}
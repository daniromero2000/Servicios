<?php

namespace App\Entities\FosygaTemps;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class FosygaTemp extends Model
{
    protected $table = 'temp_consultaFosyga';

    protected $connection = 'oportudata';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cedula');
    }
}

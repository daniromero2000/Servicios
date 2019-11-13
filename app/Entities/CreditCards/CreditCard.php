<?php

namespace App\Entities\CreditCards;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    public $table = 'TARJETA';

    public $connection = 'oportudata';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

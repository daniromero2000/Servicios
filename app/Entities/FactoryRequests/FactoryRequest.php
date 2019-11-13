<?php

namespace App\Entities\FactoryRequests;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class FactoryRequest extends Model
{
    public $table = 'SOLIC_FAB';

    public $connection = 'oportudata';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

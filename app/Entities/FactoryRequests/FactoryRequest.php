<?php

namespace App\Entities\FactoryRequests;

use App\Entities\Customers\Customer;
use App\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;

class FactoryRequest extends Model
{
    public $table = 'SOLIC_FAB';

    public $connection = 'oportudata';

    protected $primaryKey = 'SOLICITUD';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }
}
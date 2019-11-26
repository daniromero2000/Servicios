<?php

namespace App\Entities\FactoryRequests;

use App\Entities\CreditCards\CreditCard;
use App\Entities\Customers\Customer;
use App\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;

class FactoryRequest extends Model
{
    protected $table = 'SOLIC_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'SOLICITUD';

    public $timestamps = false;

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE')
            ->where('ESTADO', 'APROBADO');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, trim('CLIENTE'));
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'SOLICITUD');
    }
}

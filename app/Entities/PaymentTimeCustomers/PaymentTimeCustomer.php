<?php

namespace App\Entities\PaymentTimeCustomers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentTimeCustomer extends Model
{
    protected $table = 'payment_time';

    protected $fillable = [
        'identificationNumber',
        'credit',
        'period',
        'payment_fee',
        'payment_date',
        'expired_time'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
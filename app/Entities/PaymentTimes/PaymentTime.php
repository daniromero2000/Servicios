<?php

namespace App\Entities\PaymentTimes;

use Illuminate\Database\Eloquent\Model;

class PaymentTime extends Model
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
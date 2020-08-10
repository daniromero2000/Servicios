<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTime extends Model
{
    protected $table = 'payment_time';

    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}

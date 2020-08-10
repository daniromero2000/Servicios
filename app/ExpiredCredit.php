<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpiredCredit extends Model
{
    protected $table = 'expired_credits';

    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $table = 'customers_type';

    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}
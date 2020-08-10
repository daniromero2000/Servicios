<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrentCredit extends Model
{
    protected $table = 'current_credits';
    
    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}


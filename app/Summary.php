<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $table = 'credits_summary';

    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}
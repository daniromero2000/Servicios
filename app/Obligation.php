<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obligation extends Model
{
    protected $table = 'obligations';

    public function scopeidentification($query, $identificationNumber)
    {
        if (($identificationNumber) != "")
        {
            $query->where('identificationNumber', "LIKE","%$identificationNumber%");
        }
    }
}
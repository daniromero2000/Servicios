<?php

namespace App\Entities\ExpiredCredits;

use Illuminate\Database\Eloquent\Model;

class ExpiredCredit extends Model
{
    protected $fillable = [
       
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 
}
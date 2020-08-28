<?php

namespace App\Entities\CurrentCredits;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CurrentCredit extends Model
{
    protected $table = 'current_credits';
    
    protected $fillable = [
       
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } 
}


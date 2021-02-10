<?php

namespace App\Entities\BillPayments;

use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = [
        'name',
        'cover'
    ];

 
}

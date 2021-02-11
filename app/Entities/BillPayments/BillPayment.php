<?php

namespace App\Entities\BillPayments;

use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = [
        'address',
        'deadline',
        'status',
        'subsidiary_id',
        'type_of_invoice',
        'contract_number'
    ];
 
}

<?php

namespace App\Entities\BillPayments;

use App\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class BillPayment extends Model
{
    protected $fillable = [
        'payment_deadline',
        'status',
        'subsidiary_id',
        'type_of_invoice',
        'type_of_service',
        'payment_reference',
        'description',
        'user_id'
    ];
}

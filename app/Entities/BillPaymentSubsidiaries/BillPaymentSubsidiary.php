<?php

namespace App\Entities\BillPaymentSubsidiaries;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class BillPaymentSubsidiary extends Model
{
    use SearchableTrait;

    protected $table = 'bill_payment_subsidiaries';

    protected $fillable = [
        'code',
        'description'
    ];

    protected $searchable = [
        'columns' => [
            'bill_payments.payment_reference'   => 10,
            'bill_payments.type_of_invoice'   => 10,
            'bill_payments.type_of_service'   => 10,
        ],
    ];

}

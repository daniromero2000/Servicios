<?php

namespace App\Entities\TelephoneBillPayments;

use App\Entities\Products\Product;
use App\Entities\TypeInvoices\TypeInvoice;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TelephoneBillPayment extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'bill_payment_id',
        'telephone'
    ];

    protected $searchable = [
        'columns' => [
            'bill_payments.bill_payment_id'   => 10,
            'bill_payments.type_of_invoice'   => 10,
            'bill_payments.type_of_service'   => 10,
        ],
    ];

    public function searchTelephoneBillPayment($term)
    {
        return self::search($term);
    }

    public function typeInvoice()
    {
        return $this->belongsTo(TypeInvoice::class, 'type_of_invoice');
    }
}

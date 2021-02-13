<?php

namespace App\Entities\MailsBillPayments;

use App\Entities\Products\Product;
use App\Entities\TypeInvoices\TypeInvoice;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class MailsBillPayment extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'bill_payment_id',
        'email'
    ];

    protected $searchable = [
        'columns' => [
            'bill_payments.bill_payment_id'   => 10,
            'bill_payments.type_of_invoice'   => 10,
            'bill_payments.type_of_service'   => 10,
        ],
    ];

    public function searchMailsBillPayment($term)
    {
        return self::search($term);
    }

    public function typeInvoice()
    {
        return $this->belongsTo(TypeInvoice::class, 'type_of_invoice');
    }
}

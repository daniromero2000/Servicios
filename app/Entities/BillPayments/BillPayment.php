<?php

namespace App\Entities\BillPayments;

use App\Entities\BillPaymentStatusesLogs\BillPaymentStatusesLog;
use App\Entities\MailsBillPayments\MailsBillPayment;
use App\Entities\Products\Product;
use App\Entities\TypeInvoices\TypeInvoice;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class BillPayment extends Model
{
    use SearchableTrait;

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

    protected $searchable = [
        'columns' => [
            'bill_payments.payment_reference'   => 10,
            'bill_payments.type_of_invoice'   => 10,
            'bill_payments.type_of_service'   => 10,
        ],
    ];

    public function searchBillPayment($term)
    {
        return self::search($term);
    }

    public function typeInvoice()
    {
        return $this->belongsTo(TypeInvoice::class, 'type_of_invoice');
    }

    public function mailBillPayment()
    {
        return $this->hasMany(MailsBillPayment::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(BillPaymentStatusesLog::class)->orderBy('created_at', 'desc');
    }

    public function statusLogsPayment()
    {
        return $this->hasOne(BillPaymentStatusesLog::class)->orderBy('created_at', 'desc')->where('status', 2);
    }
}

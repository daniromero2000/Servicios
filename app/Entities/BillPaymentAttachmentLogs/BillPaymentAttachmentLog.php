<?php

namespace App\Entities\BillPaymentAttachmentLogs;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BillPaymentAttachmentLog extends Model
{
    protected $table = 'bill_payment _attachment_logs';
    protected $fillable = [
        'bill_payment_id',
        'src_invoice',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

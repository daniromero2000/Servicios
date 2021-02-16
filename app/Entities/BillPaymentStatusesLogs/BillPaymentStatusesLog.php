<?php

namespace App\Entities\BillPaymentStatusesLogs;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BillPaymentStatusesLog extends Model
{
    protected $fillable = [
        'bill_payment_id',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

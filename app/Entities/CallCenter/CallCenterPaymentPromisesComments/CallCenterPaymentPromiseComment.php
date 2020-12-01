<?php

namespace Entities\CallCenter\CallCenterPaymentPromisesComments;

use Illuminate\Database\Eloquent\Model;
use Entities\CallCenter\CallCenterPaymentPromises\CallCenterPaymentPromise;


class CallCenterPaymentPromiseComment extends Model
{
    protected $fillable = [
        'call_center_payment_promise_id',
        'comment',
    ];

    protected $hidden = [
        'id',
        'update_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function callCenterPaymentPromise()
    {
        return $this->belongsTo(CallCenterPaymentPromise::class);
    }  
}

<?php

namespace Entities\CallCenter\CallCenterPaymentPromises;

use Illuminate\Database\Eloquent\Model;
use Entities\CallCenter\CallCenterPaymentPromisesComments\CallCenterPaymentPromiseComment;
use Entities\CallCenter\CallCenterManagements\callCenterManagement;

class CallCenterPaymentPromise extends Model
{
    protected $fillable = [
        'payment_promise',
        'subsidiary_id',
        'call_center_management_id',
        'promise_date'
    ];

    protected $hidden = [
        'id',
        'update_at',
        'deleted_at'
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

    public function callCenterManagement()
    {
         return $this->belongsTo(CallCenterManagement::class);           
    }     

    public function callCenterPaymentPromiseComments()
    {
        return $this->hasMany(CallCenterPaymentPromiseComment::class);
    }
}

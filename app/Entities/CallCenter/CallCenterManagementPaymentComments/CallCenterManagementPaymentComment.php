<?php

namespace Modules\CallCenter\Entities\CallCenterManagementPaymentComments;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\CallCenterPaymentsManagement\CallCenterPaymentManagement;

class CallCenterManagementPaymentComment extends Model
{
    protected $fillable = [
        'callcenter_payment_management_id',
        'comment',
    ];

    protected $hidden = [
        'id',
        'status',
        'update_at',
        'deleted_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];   

    public function callCenterPaymentManagement()
    {
         $this->belongsTo(CallCenterPaymentManagement::class);
    }   
}

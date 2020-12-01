<?php

namespace Entities\CallCenter\CallCenterProductInterestComment;

use Entities\CallCenter\CallCenterProductInterests\CallCenterProductInterest;
use Illuminate\Database\Eloquent\Model;

class CallCenterProductInterestComment extends Model
{
    protected $fillable = [
        'call_center_product_interest_id',
        'comment',
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

    public function callCenterProductInterest()
    {
        return $this->belongsTo(CallCenterProductInterest::class);
    }     
}

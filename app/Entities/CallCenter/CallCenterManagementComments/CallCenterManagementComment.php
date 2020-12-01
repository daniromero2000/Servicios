<?php

namespace Entities\CallCenter\CallCenterManagementComments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Entities\CallCenter\CallCenterManagements\CallCenterManagement;

class CallCenterManagementComment extends Model
{

    use SoftDeletes;
    protected $table = 'callcenter_comment_managements';

    protected $fillable = [
        'callcenter_management_id',
        'comment',
        'employee_id',       
    ];

    protected $hidden = [
        'id',
        'status',
        'created_at',
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

    public function callCenterManagement()
    {
         $this->belongsTo(CallCenterManagement::class);
    }
}

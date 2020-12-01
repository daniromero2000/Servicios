<?php

namespace Entities\CallCenter\CallCenterAssignments;

use Illuminate\Database\Eloquent\Model;
use Entities\CallCenter\CallCenterCampaigns\CallCenterCampaign;
use Entities\Employees\Employee;

class CallCenterAssignment extends Model
{
    protected $fillable = [
        'employee_id',
        'call_center_campaign_id',
        'identity_number'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'id',
        'update_at',
        'update_at',
        'deleted_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',  
        'deleted_at'
    ];  

    public function callCenterEmployee()
    {
       return $this->belongsTo(Employee::class);
    }

    public function callCenterCampaign()
    {
       return $this->belongsTo(CallCenterCampaign::class);
    }  

}

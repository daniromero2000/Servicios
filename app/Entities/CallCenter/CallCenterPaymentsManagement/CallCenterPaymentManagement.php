<?php

namespace Modules\CallCenter\Entities\CallCenterPaymentsManagement;

use Illuminate\Database\Eloquent\Model;
use Modules\CallCenter\Entities\CallCenterManagementPaymentComments\CallCenterManagementPaymentComment;
use Modules\CallCenter\Entities\CallCenterManagementIndicators\CallCenterManagementIndicator;
use Modules\CallCenter\Entities\CallCenterCallQualifications\CallCenterCallQualification;
use Modules\CallCenter\Entities\CallCenterSchedules\CallCenterSchedule;
use Modules\CallCenter\Entities\CallCenterScripts\CallCenterScript;
use Modules\Companies\Entities\Employees\Employee;

class CallCenterPaymentManagement extends Model
{
    protected $fillable = [
        'id',
        'identity_number',
        'employee_id',
        'call_center_campaign_id',
        'call_center_script_id',
        'call_center_call_qualification_id',
        'call_center_management_indicator_id'
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

    public function callCenterScript()
    {
         return $this->belongsTo(CallCenterScript::class);
    }

    public function callCenterManagementIndicator()
    {
         return $this->belongsTo(CallCenterManagementIndicator::class);
    }

    public function callCenterCallQualification()
    {
         return $this->belongsTo(CallCenterCallQualification::class);
    }

    public function callCenterManagementPaymentComments()
    {
         return $this->hasMany(CallCenterManagementPaymentComment::class);           
    }

    public function callCenterSchedules()
    {
         return $this->hasMany(CallCenterSchedule::class);           
    }             

    public function callCenterEmployee()
    {
         return $this->belongsTo(Employee::class);
    }
}

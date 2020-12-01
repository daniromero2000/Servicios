<?php

namespace Entities\CallCenter\CallCenterManagements;
use Entities\CallCenter\CallCenterCallQualifications\CallCenterCallQualification;
use Entities\CallCenter\CallCenterManagementIndicators\CallCenterManagementIndicator;
use Entities\CallCenter\CallCenterManagementComments\CallCenterManagementComment;
use Entities\CallCenter\CallCenterSchedules\CallCenterSchedule;
use Entities\CallCenter\CallCenterLeads\CallCenterLead;
use Entities\CallCenter\callCenterPaymentPromises\CallCenterPaymentPromise;
use Entities\CallCenter\callCenterProductInterests\CallCenterProductInterest;
use Entities\Employees\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterManagement extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_managements';

    protected $fillable = [
        'identity_number',
        'name_answer',
        'email_answer',
        'employee_id',
        'campaign_id',
        'script_id',
        'call_qualification_id',
        'management_indicator_id'
       ];
   
       protected $hidden = [
           'id',
           'created_at',
           'update_at',
           'deleted_at',
           'status'
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
       
       public function callCenterManagementIndicator()
       {
            return $this->belongsTo(CallCenterManagementIndicator::class);
       }
   
       public function callCenterCallQualification()
       {
            return $this->belongsTo(CallCenterCallQualification::class);
       }

       public function callCenterCommentsManagements()
       {
            return $this->hasMany(CallCenterManagementComment::class);           
       }

       public function callCenterSchedules()
       {
            return $this->hasMany(CallCenterSchedule::class);           
       }

       public function callCenterLead()
       {
            return $this->belongsTo(CallCenterLead::class);           
       }      

       public function callCenterEmployee()
       {
            return $this->belongsTo(Employee::class);
       }

       public function callCenterPaymentPromises()
       {
           return $this->hasMany(CallCenterPaymentPromise::class);
       }

       public function callCenterProductInterests()
       {
           return $this->hasMany(CallCenterProductInterest::class);
       }
}

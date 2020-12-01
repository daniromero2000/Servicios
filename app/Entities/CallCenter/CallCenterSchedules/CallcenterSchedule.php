<?php

namespace Entities\CallCenter\CallCenterSchedules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Entities\Employees\Employee;
use Entities\CallCenter\CallCenterManagements\CallCenterManagement;

class CallCenterSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'call_center_schedules';

    protected $fillable = [
        'call_center_management_id',
        'call_center_schedule',
        'status'
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

    public function managements()
    {
       return $this->belongsTo(CallCenterManagement::class);
    }
}

<?php

namespace Entities\CallCenter\CallCenterCampaigns;

use Illuminate\Database\Eloquent\Model;
use Entities\CallCenter\CallCenterAssignments\CallCenterAssignment;
use Entities\CallCenter\CallCenterQuestionnaires\CallCenterQuestionnaire;
use Entities\callCenter\CallCenterManagements\CallCenterManagement;
use Entities\CallCenter\CallCenterScripts\CallCenterScript;

class CallCenterCampaign extends Model
{
    protected $fillable = [
        'name',
        'description',
        'department_id',
        'begindate',
        'endingdate',
        'questionnary_id',
        'script_id',
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

    public function callCenterQuestionnaire()
    {
       return $this->belongsTo(CallCenterQuestionnaire::class);
    }  
    
    public function callCenterAssignments()
    {
       return $this->hasMany(CallCenterAssignment::class);
    }  

    public function callCenterManagement()
    {
       return $this->belongsTo(CallCenterManagement::class);
    }
}

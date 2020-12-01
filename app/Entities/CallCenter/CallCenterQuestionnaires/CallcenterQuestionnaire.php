<?php

namespace Entities\CallCenter\CallCenterQuestionnaires;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Entities\CallCenter\CallCenterCampaigns\CallCenterCampaign;

class CallCenterQuestionnaire extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_questionnaires';

    protected $fillable = [
        'question',
        'status',
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

    public function callCenterCampaigns()
    {
        return $this->hasMany(CallCenterCampaign::class);
    }
}

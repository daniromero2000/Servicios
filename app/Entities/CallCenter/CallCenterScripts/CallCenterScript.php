<?php

namespace Entities\CallCenter\CallCenterScripts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Entities\CallCenter\CallcenterCampaigns\CallCenterCampaign;

class CallCenterScript extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_scripts';

    protected $fillable = [
        'call_center_script',
        'type',
        'status',
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

    public function callCenterCampaigns()
    {
         $this->hasMany(CallCenterCampaign::class);
    }
}

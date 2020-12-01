<?php

namespace Entities\CallCenter\CallCenterManagementIndicators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Entities\CallCenter\CallCenterManagements\CallCenterManagement;

class CallCenterManagementIndicator extends Model
{
    use SoftDeletes;

    protected $table = 'callcenter_management_indicators';

    protected $fillable = [
        'indicator',
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

    public function callCenterManagements()
    {
         $this->hasMany(CallCenterManagement::class);
    }
}

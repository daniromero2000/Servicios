<?php

namespace App\Entities\StatusManagementLogs;

use App\Entities\Leads\Lead;
use App\Entities\StatusManagements\StatusManagement;
use App\User;
use Illuminate\Database\Eloquent\Model;

class StatusManagementLog extends Model
{
    protected $fillable = [
        'id',
        'lead_id',
        'status_management_id',
        'created_at',
        'user_id'
    ];

    protected $table  = 'lead_status_management';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusManagement()
    {
        return $this->belongsTo(StatusManagement::class, 'status_management_id');
    }
}

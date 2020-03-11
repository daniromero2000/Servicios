<?php

namespace App\Entities\LeadStatusesLogs;

use App\Entities\LeadAreas\LeadArea;
use App\Entities\Leads\Lead;
use App\Entities\LeadStatuses\LeadStatus;
use App\User;
use Illuminate\Database\Eloquent\Model;

class LeadStatusesLog extends Model
{
    protected $fillable = [
        'id',
        'lead_id',
        'lead_status_id',
        'created_at',
        'updated_at',
        'user_id'
    ];

    protected $table  = 'lead_status';

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_status_id');
    }
}
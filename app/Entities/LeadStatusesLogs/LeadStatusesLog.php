<?php

namespace App\Entities\LeadStatusesLogs;

use App\Entities\Leads\Lead;
use App\Entities\LeadStatuses\LeadStatus;
use App\User;
use Illuminate\Database\Eloquent\Model;

class LeadStatusesLog extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    protected $table  = 'lead_status';

    protected $hidden = ['created_at'];

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

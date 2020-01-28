<?php

namespace App\Entities\LeadAreas;

use App\Entities\LeadAreaLeadStatuses\LeadAreaLeadStatus;
use App\Entities\LeadPriceStatuses\LeadPriceStatus;
use App\Entities\LeadProducts\LeadProduct;
use App\Entities\Leads\Lead;
use App\Entities\LeadStatuses\LeadStatus;
use App\Entities\LeadStatusesLogs\LeadStatusesLog;
use App\Entities\Services\Service;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadArea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function leadStatuses()
    {
        return $this->belongsToMany(LeadStatus::class)->withTimestamps();
    }

    public function Services()
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }

    public function leadProduct()
    {
        return $this->belongsToMany(LeadProduct::class)->withTimestamps();
    }

    public function leadPriceStatus()
    {
        return $this->belongsTo(LeadPriceStatus::class, 'lead_price_status_id');
    }
}
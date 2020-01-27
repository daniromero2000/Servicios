<?php

namespace App\Entities\LeadAreas;

use App\Entities\LeadAreaLeadStatuses\LeadAreaLeadStatus;
use App\Entities\LeadPriceStatuses\LeadPriceStatus;
use App\Entities\LeadProducts\LeadProduct;
use App\Entities\Leads\Lead;
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

    public function lead()
    {
        return $this->belongsToMany(Lead::class)->using('App\Entities\LeadAreaLeadStatuses\LeadAreaLeadStatus');
    }

    public function leadProduct()
    {
        return $this->belongsTo(LeadProduct::class);
    }

    public function leadPriceStatus()
    {
        return $this->belongsTo(LeadPriceStatus::class, 'lead_price_status_id');
    }
}
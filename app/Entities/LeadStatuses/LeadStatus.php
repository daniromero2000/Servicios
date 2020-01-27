<?php

namespace App\Entities\LeadStatuses;

use App\Entities\LeadAreas\LeadArea;
use App\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;


class LeadStatus extends Model
{

    protected $fillable = [
        'name',
        'color',
    ];

    protected $table = 'lead_statuses';


    protected $hidden = [];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function areas()
    {
        return $this->belongsToMany(LeadArea::class)->using('App\Entities\LeadAreaLeadStatuses\LeadAreaLeadStatus');
    }
}
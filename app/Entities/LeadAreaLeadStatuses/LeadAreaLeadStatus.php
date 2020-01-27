<?php

namespace App\Entities\LeadAreaLeadStatuses;

use App\Entities\LeadPriceStatuses\LeadPriceStatus;
use App\Entities\LeadProducts\LeadProduct;
use App\Entities\Leads\Lead;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadAreaLeadStatus extends Pivot
{
}
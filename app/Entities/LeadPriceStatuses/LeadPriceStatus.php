<?php

namespace App\Entities\LeadPriceStatuses;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeadPriceStatus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'color'
    ];
}

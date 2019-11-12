<?php

namespace App\Entities\Campaigns;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'name',
        'description',
        'socialNetwork',
        'beginDate',
        'endingDate',
        'budget',
        'usedBudget'
    ];
}

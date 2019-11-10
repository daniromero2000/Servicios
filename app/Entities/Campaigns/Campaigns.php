<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
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

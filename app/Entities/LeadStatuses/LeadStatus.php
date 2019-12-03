<?php

namespace App\Entities\LeadStatuses;

use App\Entities\Leads\Lead;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}

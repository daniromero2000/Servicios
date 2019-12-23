<?php

namespace App\Entities\Leads;

use App\Entities\Channels\Channel;
use App\Entities\Comments\Comment;
use App\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nicolaslopezj\Searchable\SearchableTrait;


class Lead extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'telephone',
        'city',
        'typeService',
        'typeProduct',
        'state',
        'channel',
        'termsAndConditions',
        'typeDocument',
        'identificationNumber',
        'assessor',
        'nearbyCity',
        'assessor_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'leads.name'   => 1,
        ],
    ];

    public function searchLeads($term)
    {
        return self::search($term);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'idLead');
    }

    public function leadStatus()
    {
        return $this->belongsToMany(LeadStatus::class, 'lead_status', 'lead_id', 'lead_status_id')->withTimestamps();
    }

    public function leadStatuses()
    {
        return $this->belongsTo(LeadStatus::class, 'state', 'id');
    }

    public function leadChannel()
    {
        return $this->belongsTo(Channel::class, 'channel', 'id');
    }
}

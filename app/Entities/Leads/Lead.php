<?php

namespace App\Entities\Leads;

use App\Entities\Campaigns\Campaign;
use App\Entities\Channels\Channel;
use App\Entities\Comments\Comment;
use App\Entities\LeadAreas\LeadArea;
use App\Entities\LeadPrices\LeadPrice;
use App\Entities\LeadProducts\LeadProduct;
use App\Entities\AssessorQuotations\AssessorQuotation;
use App\Entities\LeadStatuses\LeadStatus;
use App\Entities\LeadStatusesLogs\LeadStatusesLog;
use App\Entities\Services\Service;
use App\Entities\StatusManagements\StatusManagement;
use App\Entities\Subsidiaries\Subsidiary;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Entities\StatusManagementLogs\StatusManagementLog;


class Lead extends Model
{
    use SearchableTrait;
    use SoftDeletes;

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
        'assessor_id',
        'description',
        'lead_area_id',
        'expirationDateSoat',
        'subsidiary_id',
        'statusManagement'
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
            'leads.name'      => 10,
            'leads.lastName'  => 10,
            'leads.telephone' => 10,
            'leads.identificationNumber' => 10,
        ],
    ];


    public function searchLeads($term)
    {
        return self::search($term);
    }

    public function searchLeadsSubsidiaries($term)
    {
        return self::search($term);
    }

    public function searchCustomLeads($term)
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

    public function statusManagements()
    {
        return $this->belongsToMany(StatusManagement::class, 'lead_status_management', 'lead_id', 'status_management_id')->withTimestamps();
    }

    public function leadStatuses()
    {
        return $this->belongsTo(LeadStatus::class, 'state', 'id');
    }

    public function leadChannel()
    {
        return $this->belongsTo(Channel::class, 'channel', 'id');
    }

    public function leadAssessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function leadService()
    {
        return $this->belongsTo(Service::class, 'typeService');
    }

    public function leadCampaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign');
    }

    public function leadStatusesLogs()
    {
        return $this->hasMany(LeadStatusesLog::class, 'lead_id');
    }

    public function statusManagementLog()
    {
        return $this->hasMany(StatusManagementLog::class, 'lead_id');
    }

    public function leadProduct()
    {
        return $this->belongsTo(LeadProduct::class, 'typeProduct');
    }

    public function leadPrices()
    {
        return $this->hasMany(LeadPrice::class);
    }

    public function LeadArea()
    {
        return $this->belongsTo(LeadArea::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }

    public function leadQuotations()
    {
        return $this->hasMany(AssessorQuotation::class)->with('quotationValues');
    }
}

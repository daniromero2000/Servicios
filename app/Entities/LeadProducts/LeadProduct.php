<?php

namespace App\Entities\LeadProducts;

use App\Entities\LeadAreas\LeadArea;
use Illuminate\Database\Eloquent\Model;

class LeadProduct extends Model
{
    protected $fillable = [
        'lead_product',
        'service_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function leadArea()
    {
        return $this->belongsToMany(LeadArea::class)->withTimestamps();
    }
}
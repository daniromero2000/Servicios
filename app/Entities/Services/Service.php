<?php

namespace App\Entities\Services;

use App\Entities\LeadAreas\LeadArea;
use App\Entities\LeadProducts\LeadProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';

    protected $fillable = [
        'id',
        'service',
    ];

    public function factoryRequests()
    {
        return $this->belongsTo(LeadProduct::class);
    }

    public function leadArea()
    {
        return $this->belongsToMany(LeadArea::class)->withTimestamps();
    }
}
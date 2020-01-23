<?php

namespace App\Entities\Services;

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
}
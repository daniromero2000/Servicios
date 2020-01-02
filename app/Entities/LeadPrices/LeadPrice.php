<?php

namespace App\Entities\LeadPrices;

use App\Entities\Leads\Lead;
use App\User;
use Illuminate\Database\Eloquent\Model;

class LeadPrice extends Model
{
    protected $fillable = [
        'lead_product_id',
        'description',
        'lead_price',
        'lead_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idLogin');
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}

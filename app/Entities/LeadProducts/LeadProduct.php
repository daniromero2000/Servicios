<?php

namespace App\Entities\LeadProducts;

use Illuminate\Database\Eloquent\Model;

class LeadProduct extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];
}

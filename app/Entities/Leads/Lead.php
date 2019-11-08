<?php

namespace App\Entities\Leads;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

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
        'nearbyCity'
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
}

<?php

namespace App\Entities\ConfrontResults;

use Illuminate\Database\Eloquent\Model;

class ConfrontResult extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'confron_form_id',
        'hits'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

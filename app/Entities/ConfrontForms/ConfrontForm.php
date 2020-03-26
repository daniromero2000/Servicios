<?php

namespace App\Entities\ConfrontForms;

use Illuminate\Database\Eloquent\Model;

class ConfrontForm extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'identificationNumber'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

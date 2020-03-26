<?php

namespace App\Entities\ConfrontQuestions;

use Illuminate\Database\Eloquent\Model;

class ConfrontQuestion extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'id',
        'question',
        'type'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

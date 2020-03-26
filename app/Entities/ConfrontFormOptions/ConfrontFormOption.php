<?php

namespace App\Entities\ConfrontFormOptions;

use Illuminate\Database\Eloquent\Model;

class ConfrontFormOption extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'confront_form_question_id',
        'option',
        'correct_option'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

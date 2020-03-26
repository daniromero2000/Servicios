<?php

namespace App\Entities\ConfrontFormAnswers;

use Illuminate\Database\Eloquent\Model;

class ConfrontFormAnswer extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'confront_form_id',
        'confront_form_question_id',
        'confront_form_option_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

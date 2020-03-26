<?php

namespace App\Entities\ConfrontFormQuestions;

use Illuminate\Database\Eloquent\Model;

class ConfrontFormQuestion extends Model
{
    protected $connection = 'oportudata';

    protected $fillable = [
        'confront_question_id',
        'confront_form_id'

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

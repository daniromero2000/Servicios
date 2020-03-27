<?php

namespace App\Entities\ConfrontFormOptions;

use App\Entities\ConfrontFormAnswers\ConfrontFormAnswer;
use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
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

    public function confrontFormQuestion()
    {
        return $this->belongsTo(ConfrontFormQuestion::class);
    }

    public function answer()
    {
        return $this->hasOne(ConfrontFormAnswer::class);
    }
}

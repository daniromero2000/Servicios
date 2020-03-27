<?php

namespace App\Entities\ConfrontFormQuestions;

use App\Entities\ConfrontFormAnswers\ConfrontFormAnswer;
use App\Entities\ConfrontFormOptions\ConfrontFormOption;
use App\Entities\ConfrontForms\ConfrontForm;
use App\Entities\ConfrontQuestions\ConfrontQuestion;
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

    public function form()
    {
        return $this->belongsTo(ConfrontForm::class);
    }

    public function confrontQuestion()
    {
        return $this->belongsTo(ConfrontQuestion::class);
    }

    public function options()
    {
        return $this->hasMany(ConfrontFormOption::class);
    }

    public function answer()
    {
        return $this->hasOne(ConfrontFormAnswer::class);
    }
}

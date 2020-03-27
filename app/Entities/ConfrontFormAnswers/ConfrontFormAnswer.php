<?php

namespace App\Entities\ConfrontFormAnswers;

use App\Entities\ConfrontFormOptions\ConfrontFormOption;
use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
use App\Entities\ConfrontForms\ConfrontForm;
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

    public function form()
    {
        return $this->belongsTo(ConfrontForm::class);
    }

    public function question()
    {
        return $this->belongsTo(ConfrontFormQuestion::class);
    }

    public function option()
    {
        return $this->belongsTo(ConfrontFormOption::class);
    }

}

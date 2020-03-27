<?php

namespace App\Entities\ConfrontForms;

use App\Entities\ConfrontFormAnswers\ConfrontFormAnswer;
use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
use App\Entities\ConfrontResults\ConfrontResult;
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

    public function questions()
    {
        return $this->hasMany(ConfrontFormQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(ConfrontFormAnswer::class);
    }

    public function result()
    {
        return $this->hasOne(ConfrontResult::class);
    }
}

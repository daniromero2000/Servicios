<?php

namespace App\Entities\ConfrontForms;

use App\Entities\ConfrontFormAnswers\ConfrontFormAnswer;
use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
use App\Entities\ConfrontResults\ConfrontResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfrontForm extends Model
{
    use SoftDeletes;

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
        return $this->hasMany(ConfrontFormQuestion::class)->with(['options', 'confrontQuestion']);
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

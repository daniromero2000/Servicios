<?php

namespace App\Entities\ConfrontQuestions;

use App\Entities\ConfrontFormQuestions\ConfrontFormQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConfrontQuestion extends Model
{
    use SoftDeletes;

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

    public function formQuestions()
    {
        return $this->hasMany(ConfrontFormQuestion::class);
    }
}

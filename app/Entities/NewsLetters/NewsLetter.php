<?php

namespace App\Entities\NewsLetters;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $fillable = ['email', 'termsAndConditions'];

    protected $table = 'newsletters';
}

<?php

namespace App\Entities\NewsLetters;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    protected $table = 'newsletters';

    protected $fillable = ['email'];
}

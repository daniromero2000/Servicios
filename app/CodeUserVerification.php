<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeUserVerification extends Model
{
    protected $table = 'code_user_verification';

    protected $fillable = ['code', 'identification'];
}

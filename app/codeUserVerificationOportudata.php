<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codeUserVerificationOportudata extends Model
{
    protected $table = 'code_user_verification';

    public $connection='oportudata';

    public $timestamps = false;

    protected $fillable = ['code', 'identification', 'created_at'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codeUserVerificationOportudata extends Model
{
    protected $table = 'code_user_verification';

    public $connection='oportudata';

    protected $primaryKey= 'identificador';

    public $timestamps = false;

    protected $fillable = ['token', 'identification', 'created_at'];
}

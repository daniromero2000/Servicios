<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codeUserVerificationOportudata extends Model
{
    protected $table = 'code_user_verification';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    public $timestamps = false;

    protected $fillable = [
        'identificador',
        'token',
        'identificationNumber',
        'telephone',
        'created_at',
        'type',
        'state'
    ];
}
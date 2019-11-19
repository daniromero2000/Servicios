<?php

namespace App\Entities\CustomerVerificationCodes;

use Illuminate\Database\Eloquent\Model;

class CustomerVerificationCode extends Model
{
    protected $table = 'code_user_verification';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    public $timestamps = false;

    protected $fillable = [
        'token',
        'identification',
        'created_at'
    ];
}

<?php

namespace App\Entities\CustomerVerificationCodes;

use Illuminate\Database\Eloquent\Model;

class CustomerVerificationCode extends Model
{
    protected $table = 'code_user_verification';

    protected $connection = 'oportudata';

    protected $primaryKey = 'identificador';

    protected $fillable = [
        'token',
        'identificationNumber',
        'telephone',
        'created_at',
        'state',
        'type'
    ];

protected $dates = [
    'created_at',
];
}

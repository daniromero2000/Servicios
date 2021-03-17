<?php

namespace App;

use App\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CodeUserVerification extends Model
{
    protected $table = 'code_user_verification';

    protected $fillable = [
        'code',
        'identificationNumber',
        'type',
        'telephone',
        'attempt'
    ];

  
}

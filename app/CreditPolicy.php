<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class CreditPolicy extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;
    public $table='credit_policy';
    protected $fillable=['score','timeLimit'];
    public $timestamps = false;

}

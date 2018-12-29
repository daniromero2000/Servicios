<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class ProfilesAssessor extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    public $table="profiles_assessor";
    protected $fillable=['code','profile'];
}

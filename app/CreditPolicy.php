<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditPolicy extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $table='credit_policy';
    protected $fillable=['name', 'score', 'scoreEnd', 'salary', 'salaryEnd', 'age', 'ageEnd', 'activity', 'quotaApproved'];
    public $timestamps = false;

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditPolicy extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    public $table='VIG_CONSULTA';
    protected $fillable=['fab_vigencia', 'pub_vigencia'];
    public $timestamps = false;
}

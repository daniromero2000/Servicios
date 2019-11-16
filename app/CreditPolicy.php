<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class CreditPolicy extends \Eloquent implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'VIG_CONSULTA';

    protected $fillable = [
        'fab_vigencia',
        'pub_vigencia'
    ];

    public $timestamps = false;
}

<?php

namespace App\Entities\CreditBusiness;

use Illuminate\Database\Eloquent\Model;

class CreditBusines extends Model
{
    protected $table = 'SUPER';

    protected $connection = 'oportudata';

    public $timestamps = false;
}
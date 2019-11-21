<?php

namespace App\Entities\CifinRealArrears;

use Illuminate\Database\Eloquent\Model;

class CifinRealArrear extends Model
{
    protected $table = 'cifin_realmora';

    protected $connection = 'oportudata';

    protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

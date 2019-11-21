<?php

namespace App\Entities\CifinArrears;

use Illuminate\Database\Eloquent\Model;

class CifinArrear extends Model
{
    protected $table = 'cifin_finmora';

    protected $connection = 'oportudata';

    protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

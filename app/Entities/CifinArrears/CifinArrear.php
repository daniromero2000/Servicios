<?php

namespace App\Entities\CifinArrears;

use Illuminate\Database\Eloquent\Model;

class CifinArrear extends Model
{
    protected $table = 'cifin_finmora';

    protected $connection = 'oportudata';

    protected $primaryKey =  'finconsul';

    public $timestamps = false;
}

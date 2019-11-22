<?php

namespace App\Entities\CifinFinancialArrears;

use Illuminate\Database\Eloquent\Model;

class CifinFinancialArrear extends Model
{
    protected $table = 'cifin_finmora';

    protected $connection = 'oportudata';

    protected $primaryKey =  'finconsul';

    public $timestamps = false;
}

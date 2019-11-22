<?php

namespace App\Entities\ExtintFinancialCifins;

use Illuminate\Database\Eloquent\Model;

class ExtintFinancialCifin extends Model
{
    protected $table = 'cifin_finext';

    protected $connection = 'oportudata';

    // protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

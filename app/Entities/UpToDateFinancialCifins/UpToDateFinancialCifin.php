<?php

namespace App\Entities\UpToDateFinancialCifins;

use Illuminate\Database\Eloquent\Model;

class UpToDateFinancialCifin extends Model
{
    protected $table = 'cifin_findia';

    protected $connection = 'oportudata';

    // protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

<?php

namespace App\Entities\UpToDateRealCifins;

use Illuminate\Database\Eloquent\Model;

class UpToDateRealCifin extends Model
{
    protected $table = 'cifin_realdia';

    protected $connection = 'oportudata';

    protected $primaryKey = 'rdconsul';

    public $timestamps = false;
}
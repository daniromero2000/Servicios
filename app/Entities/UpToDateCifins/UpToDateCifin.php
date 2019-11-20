<?php

namespace App\Entities\UpToDateCifins;

use Illuminate\Database\Eloquent\Model;

class UpToDateCifin extends Model
{
    protected $table = 'cifin_findia';

    protected $connection = 'oportudata';

    protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

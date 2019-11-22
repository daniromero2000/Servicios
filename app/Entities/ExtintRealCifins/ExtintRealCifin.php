<?php

namespace App\Entities\ExtintRealCifins;

use Illuminate\Database\Eloquent\Model;

class ExtintRealCifin extends Model
{
    protected $table = 'cifin_realext';

    protected $connection = 'oportudata';

    // protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

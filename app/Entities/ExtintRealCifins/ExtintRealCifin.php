<?php

namespace App\Entities\ExtintRealCifinss;

use Illuminate\Database\Eloquent\Model;

class ExtintRealCifins extends Model
{
    protected $table = 'cifin_realext';

    protected $connection = 'oportudata';

    // protected $primaryKey =  'fdconsul';

    public $timestamps = false;
}

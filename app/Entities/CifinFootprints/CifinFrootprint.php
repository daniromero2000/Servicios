<?php

namespace App\Entities\CifinFootprints;

use Illuminate\Database\Eloquent\Model;

class CifinFrootprint extends Model
{
    protected $table = 'cifin_huellas';

    protected $connection = 'oportudata';

    protected $primaryKey = 'hueconsul';

    public $timestamps = false;
}
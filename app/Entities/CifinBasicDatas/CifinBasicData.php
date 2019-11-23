<?php

namespace App\Entities\CifinBasicDatas;

use Illuminate\Database\Eloquent\Model;

class CifinBasicData extends Model
{
    protected $table = 'cifin_tercero';

    protected $connection = 'oportudata';

    protected $primaryKey =  'terconsul';

    public $timestamps = false;
}

<?php

namespace App\Entities\IntentionStatuses;

use App\Entities\Intentions\Intention;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IntentionStatus extends Model
{
    protected $table = 'ESTADOINTENCIONES';

    protected $connection = 'oportudata';

    protected $primaryKey =  'ID';

    public $timestamps = false;

    public function intentions()
    {
        return $this->hasMany(Intention::class, 'ESTADO_INTENCION');
    }
}

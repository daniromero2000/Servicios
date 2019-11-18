<?php

namespace App\Entities\ConsultationValidities;

use Illuminate\Database\Eloquent\Model;

class ConsultationValidity extends Model
{
    protected $table = 'VIG_CONSULTA';

    protected $connection = 'oportudata';

    public $timestamps = false;
}

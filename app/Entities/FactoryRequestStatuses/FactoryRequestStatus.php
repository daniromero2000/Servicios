<?php

namespace App\Entities\FactoryRequestStatuses;

use Illuminate\Database\Eloquent\Model;

class FactoryRequestStatus extends Model
{
    protected $connection = 'oportudata';

    protected $table = 'ESTADOSOLICITUDES';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'color',
        'grupo',
        'secuencia',
        'editable'
    ];
}

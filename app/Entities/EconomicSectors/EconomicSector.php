<?php

namespace App\Entities\EconomicSectors;

use Illuminate\Database\Eloquent\Model;

class EconomicSector extends Model
{
    protected $table = 'economic_sectors';

    protected $connection = 'oportudata';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'status'
    ];
}

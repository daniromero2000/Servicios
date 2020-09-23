<?php

namespace App\Entities\CustomerCellPhones;

use Illuminate\Database\Eloquent\Model;

class CustomerCellPhone extends Model
{
    protected $table = 'CLI_CEL';

    protected $connection = 'oportudata';

    protected $primaryKey = 'IDENTI';

    public $timestamps = false;

    protected $fillable = [
        'IDENTI',
        'NUM',
        'CEL_VAL',
        'TIPO',
        'FECHA'
    ];
}
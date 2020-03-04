<?php

namespace App\Entities\CustomerProfessions;

use Illuminate\Database\Eloquent\Model;

class CustomerProfession extends Model
{
    protected $table = 'PROFESIONES';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CODIGO';

    public $timestamps = false;

    protected $fillable = [
        'CODIGO',
        'NOMBRE',
        'STATE'
    ];
}
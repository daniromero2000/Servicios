<?php

namespace App\Entities\TemporaryCustomers;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TemporaryCustomer extends Model
{
    use SearchableTrait;

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    protected $fillable = [
        'TIPO_DOC',
        'CEDULA',
        'FEC_EXP',
        'NOMBRES',
        'APELLIDOS',
        'ACTIVIDAD',
        'EMAIL',
        'FEC_ING',
        'CIUD_UBI',
        'FEC_CONST',
        'CELULAR'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $searchable = [];
}

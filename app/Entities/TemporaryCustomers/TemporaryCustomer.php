<?php

namespace App\Entities\TemporaryCustomers;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TemporaryCustomer extends Model
{
    use SearchableTrait;

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    protected $fillable = [];

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
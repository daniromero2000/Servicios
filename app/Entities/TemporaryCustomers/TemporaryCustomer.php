<?php

namespace App\Entities\TemporaryCustomers;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TemporaryCustomer extends Model
{
    use SearchableTrait;

    protected $connection = 'oportudata';

    protected $primaryKey = 'identification';

    public $timestamps = false;

    protected $fillable = [];

    protected $hidden = [];

    protected $searchable = [];
}
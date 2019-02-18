<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';

    public $timestamps = false;

    protected $fillable = ['name', 'icon', 'route'];
}

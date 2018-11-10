<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $fillable = ['name', 'lastName', 'email', 'telephone', 'city', 'typeService', 'typeProduct','state','channel'];
}

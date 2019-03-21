<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulator extends Model
{
    protected $table = 'simulator';
    protected $fillable = ['rate','fee','assurance'];
}

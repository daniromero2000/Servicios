<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotosTimeLimits extends Model
{
    protected $table = 'motos_timelimits';

    public $timestamps = false;

    protected $fillable = ['timeLimit'];
}

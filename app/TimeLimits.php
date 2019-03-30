<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeLimits extends Model
{
    protected $table = 'timelimits';    
 
    protected $fillable = ['timeLimit'];

}

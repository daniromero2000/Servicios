<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages'; 

    public $timestamps = false;
 
    protected $fillable = ['name', 'description','content'];

  

}

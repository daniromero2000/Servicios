<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fqa extends Model
{
    protected $table = 'fqas';

    protected $fillable = ['id','question','answer','user'];
}

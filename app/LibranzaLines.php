<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibranzaLines extends Model
{
    protected $table = 'libranza_lines';

    public $timestamps = false;

    protected $fillable = ['name'];
}

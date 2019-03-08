<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibranzaProfile extends Model
{
    protected $table = 'libranza_profiles';

    public $timestamps = false;

    protected $fillable = ['name'];
}

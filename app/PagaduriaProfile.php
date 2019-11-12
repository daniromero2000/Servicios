<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagaduriaProfile extends Model
{
    protected $table = 'pagadurias_libranza_profiles';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'idPagaduria',
        'idProfile'
    ];
}

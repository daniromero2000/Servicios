<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagaduria extends Model
{
    protected $table = 'pagaduria';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'office',
        'city',
        'departament',
        'active',
        'category'
    ];
}

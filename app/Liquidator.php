<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidator extends Model
{
    protected $table = 'liquidator';

    public $timestamps = false;

    protected $fillable = [
        'creditLine',
        'pagaduria',
        'age',
        'customerType',
        'salary',
        'amount',
        'timeLimit'
    ];
}

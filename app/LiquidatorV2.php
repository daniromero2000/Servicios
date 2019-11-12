<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiquidatorV2 extends Model
{
    protected $table = 'liquidator';

    protected $fillable = [
        'creditLine',
        'pagaduria',
        'age',
        'customerType',
        'salary'
    ];
}

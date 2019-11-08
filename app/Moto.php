<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = 'motos';

    protected $fillable = [
        'image',
        'brand',
        'ABS',
        'details',
        'manual',
        'name',
        'description',
        'price',
        'buttonText',
        'fee',
        'type',
        'power',
        'torque',
        'compression',
        'start',
        'engine',
        'displacement',
        'frontBrake',
        'rearBrake',
        'frontSuspension',
        'backSuspension',
        'tireFront',
        'tireBack',
        'ignition',
        'long',
        'height',
        'seatHeight',
        'width',
        'weight',
        'wheels',
        'tank',
        'axisDistance'
    ];
}

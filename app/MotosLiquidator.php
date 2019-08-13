<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotosLiquidator extends Model
{
    protected $table = 'motos_liquidator';

    public $timestamps = false;

    protected $fillable = ['idMoto','initialFee','timeLimit'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'img',
        'title',
        'description',
        'textButton',
        'category',
        'isSlide'
    ];
}

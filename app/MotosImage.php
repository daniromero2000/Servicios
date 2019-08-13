<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotosImage extends Model
{
    protected $table = 'motos_images';

    public $timestamps = false;

    protected $fillable = ['image1', 'image2', 'image3','image4','image5','id_moto'];
}

<?php

  /**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of Use: MODULO CATALOGO DE PRODUCTOS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: model for products images
    **Date: 11/01/2019
     **/

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    
	protected $dates = ['deleted_at'];

    protected $table = 'product_images';

    protected $fillable = ['id','name','order','idProduct'];
}

<?php
  /**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: model for products 
    **Fecha: 22/12/2018
     **/

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $fillable = ['id','name','reference','idBrand','idLine','id_city','specifications'];
}

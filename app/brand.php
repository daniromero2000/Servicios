<?php

    /**
    **Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: model for brands
    **Fecha: 12/12/2018
     **/

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $table = 'brands';

    protected $fillable = ['id','name'];
}

<?php

    /**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: model for products cities profiles
    **Fecha: 11/12/2018
     **/

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProfilesCity extends Model
{
    use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $table = 'Profiles_cities';

    protected $fillable = ['id','name'];
}

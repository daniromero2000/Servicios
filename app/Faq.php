<?php

    /**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: model for FAQS
    **Fecha: 12/12/2018
     **/


namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = ['id','question','answer','user_id'];
}

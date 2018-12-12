<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameFqasToFaqs extends Migration
{

    /**
     * Display a listing of the resource and filter by question.
     /Proyecto: SERVISIOS FINANCIEROS
    **Caso de Uso: MODULO FAQS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: change the name for faqs table
    **Fecha: 12/12/2018
     */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('fqas','faqs');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faqs');
    }
}

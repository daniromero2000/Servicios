<?php 
/**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO DE PRODUCTOS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Date: 17/01/2019
     **/

Route::group(['prefix'=>'/Catalog/'],function(){

	//display catalog layout
    Route::get("/",function(){
            return view('catalog.public.layout');
        })->name('catalog');
    //render internal catalog
    Route::get('/products', function(){
        return view('catalog.public.catalog');
    });
    //get lines and brands
    Route::get('/linesBrands','Admin\ProductsController@linesBrands');
});
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
    Route::get('/index', function(){
        return view('catalog.public.catalog');
    });
    //renders a details of a selected product
    Route::get('/details', function(){
        return view('catalog.public.details');
    });
    //get lines and brands
    Route::get('/linesBrands','Admin\ProductsController@linesBrands');
    //get filter products list
    Route::get('/products','Admin\ProductsController@productsPublic');
    //get information of selected product
    Route::get('/productDetails','Admin\ProductsController@productsDetails');
});


/**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIA DIGITAL
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Date: 28/02/2019
     **/
Route::group(['prefix'=>'/digitalWarranty/'],function(){

	//display layout warrty app 
    Route::get("/",function(){
        return view('warranty.public.layout');
    })->name('warranty');
    //render query
    Route::get('/Query', function(){
        return view('warranty.public.query');
    });
    Route::get('/TermsConditions', function(){
        return view('warranty.public.termsAndConditions');
    })->name('TermsAndConditions');
});
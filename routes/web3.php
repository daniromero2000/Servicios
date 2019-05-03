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
    //CRUD routes digital warranty 
    Route::resource('request','Admin\WarrantyController');
	//display layout warrty app 
    Route::get("/",'Admin\WarrantyController@index')->name('warranty');
    //render query view
    Route::get('/Query', function(){
        return view('warranty.public.query');
    });
    //display terms and conditions view
    Route::get('/TermsConditions', function(){
        return view('warranty.public.termsAndConditions');
    })->name('TermsAndConditions');
    //Request a code verification by sms
    Route::get('/getCodeVerification/{identificationNumber}/{celNumber}', 'Admin\WarrantyController@getCodeVerificationOportudata');
    //Confirm a code verification
    Route::get('/verificationCode/{code}/{identificationNumber}', 'Admin\WarrantyController@verificationCode');
    // get the list of the bought products by the client in the last four years
    Route::post('/products', 'Admin\WarrantyController@products');
    //test a mail view
    Route::get("mail",function(){
        return view('emails.alertWarrantyClient');
    });
});
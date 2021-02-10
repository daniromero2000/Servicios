<?php


use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/admin/'], function () {
    Route::get('/', function () {
        return view('adminlte.admin');
    });
    Route::get('/modules', function () {
        return view('adminlte.modulesV2');
    });
});


Route::group(['prefix' => '/seguros/'], function () {
    Route::get('/taxis', function () {
        return view('seguros.taxis.index');
    });
});

Route::group(['prefix' => '/Catalog/'], function () {
    //display catalog layout
    Route::get("/", function () {
        return view('catalog.public.layout');
    })->name('catalog');
    //render internal catalog
    Route::get('/index', function () {
        return view('catalog.public.catalog');
    });
    //renders a details of a selected product
    Route::get('/details', function () {
        return view('catalog.public.details');
    });
    //get lines and brands
    Route::get('/linesBrands', 'Admin\ProductsController@linesBrands');
    //get filter products list
    Route::get('/products', 'Admin\ProductsController@productsPublic');
    //get information of selected product
    Route::get('/productDetails', 'Admin\ProductsController@productsDetails');
});



Route::group(['prefix' => '/digitalWarranty/'], function () {

    //CRUD routes digital warranty
    Route::resource('request', 'Admin\WarrantyController');

    //display layout warrty app
    Route::get("/", 'Admin\WarrantyController@index')->name('warranty');

    //render query view
    Route::get('/Query', function () {
        return view('warranty.public.query');
    });

    //display terms and conditions view
    Route::get('/TermsConditions', function () {
        return view('warranty.public.termsAndConditions');
    })->name('TermsAndConditions');

    //Request a code verification by sms
    Route::get('/getCodeVerification/{identificationNumber}/{celNumber}', 'Admin\WarrantyController@getCodeVerificationOportudata');
    //Confirm a code verification
    Route::get('/verificationCode/{code}/{identificationNumber}', 'Admin\WarrantyController@verificationCode');
    // get the list of the bought products by the client in the last four years
    Route::post('/products', 'Admin\WarrantyController@products');
    //test a mail view
    Route::get("mail", function () {
        return view('emails.alertWarrantyClient');
    });
    //Confirm a code verification
    Route::get('/test', 'Admin\WarrantyController@test');
    // send a emails notification for new Warranty
    Route::post('/sendAWarrantyEmail', 'Admin\WarrantyController@sendAWarrantyEmail');
});


/**
 * Admin routes
 */

Route::group(['prefix' => 'admin'], function () {
    Route::namespace('Auth')->group(function () {
        Route::get('loginform', 'LoginAdminController@showLoginFormAdmin')->name('loginform');
        Route::post('loginform', 'LoginAdminController@login');
    });

    Route::namespace('NewAdmin')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

        Route::namespace('BillPayments')->group(function () {
            Route::resource('gestion-facturas', 'BillPaymentController');
        });
        
    });
});

// Route::get('admin/loginform', 'Auth\LoginAdminController@showLoginFormAdmin')->name('loginform');
// Route::post('admin/loginform', 'Auth\LoginAdminController@login');


Route::namespace('Admin')->group(function () {

    Route::namespace('Products')->group(function () {
        Route::resource('Administrator/products', 'ProductController');
        Route::get('remove-image-product', 'ProductController@removeThumbnail')->name('product.remove.image');
        Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
    });
    Route::namespace('Catalogs')->group(function () {
        Route::resource('Administrator/catalog', 'CatalogController');
    });

    Route::resource('Administrator/brands', 'Brands\BrandController');
});
<?php 

//libranza routes

Route::resource('libranzaV2','Admin\LibranzaV2Controller');
Route::resource('newsletter','Admin\newsletterController');

Route::group(['prefix'=>'/creditoLibranza/'],function(){

    Route::get('/step1','Admin\LibranzaV2Controller@step1')->name('step1Libranza');
    Route::get('/getDataStep1','Admin\LibranzaV2Controller@getDataStep1');
    Route::get('/getDataStep2/{numIdentification}','Admin\LibranzaV2Controller@getDataStep2');
    Route::get('/getDataStep3/{numIdentification}','Admin\LibranzaV2Controller@getDataStep3');
    Route::post('/saveStep1','Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::post('/saveStep2','Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::get('/step2/{numIdentification}', 'Admin\LibranzaV2Controller@step2')->name('libranzaStep2');
    Route::get('/decryptText/{string}','Admin\LibranzaV2Controller@decrypt');
    Route::get('/step2Data/{numIdentification}','Admin\LibranzaV2Controller@getIDStep2');
    Route::get('/step3/{numIdentification}', 'Admin\LibranzaV2Controller@step3')->name('libranzaStep3');
    Route::get('/encryptText/{string}','Admin\LibranzaV2Controller@encrypt');
    Route::get('/cities', 'Admin\LibranzaV2Controller@cities')->name('step1Cities');

})  ;
Route::resource('avance','Admin\AdvanceController');
//Route::get('libranza-lines','Admin\LibranzaController@index');

//Route::get('/getDataLibranza','Admin\LibranzaController@getData');

Route::group(['prefix'=>'/libranza-principal/'],function(){
    Route::get('/', function(){
        return view('libranza.index');
    });
    Route::get('/simulador', function(){
        return view('libranza.simulador');
    });

    Route::get('/templateDialog', function(){
        return view('libranza.template');
    });

    Route::get('/templateDialogLI', function(){
        return view('libranza.templateLI');
    });

    Route::get('/resumen', function(){
        return view('libranza.resumen');
    });

       
    Route::get('/libranza-lines',function(){    
        return view('libranza.libranza');       
    });
});

Route::get('/Terminos-y-condiciones-simulador', function(){
	return view('menuItems.termsLibranza');
})->name('termsAndConditionsLibranza');

Route::resource('simulator','Admin\SimulatorController');
Route::get('simulador/getDataSimulador','Admin\SimulatorController@getData');
Route::delete('/deletePagaduria/{idPagaduria}','Admin\SimulatorController@deletePagaduria');
Route::delete('/deleteProfileLibranza/{idProfile}','Admin\SimulatorController@deleteProfile');
Route::post('/createPagaduria','Admin\SimulatorController@addPagaduria');
Route::post('/createProfileLibranza','Admin\SimulatorController@addProfile');
Route::put('/updatePagaduria/{idPagaduria}','Admin\SimulatorController@updatePagaduria');
Route::get('/OPN_gracias_newsletter',function(){
    return view('newsletter.index');
})->name('thankYouPageNewsletter');

Route::group(['prefix'=>'/motos/solicitud/'],function(){
    
    Route::get('/step1', function(){
        return view('motos.step1');
    });
    Route::get('/thankYouPage', function(){
        return view('motos.thankYouPage');
    });    
    Route::get('/step2/{numIdentification}', 'Admin\MotosController@step2')->name('step2Motos');
    Route::get('/step3/{numIdentification}', 'Admin\MotosController@step3')->name('step3Motos');
    Route::get('getDataMotoStep1','Admin\MotosController@getDataStep1');
    Route::get('getDataMotoStep2/{identificationNumber}','Admin\MotosController@getDataStep2');
    Route::get('getDataMotoStep3/{identificationNumber}','Admin\MotosController@getDataStep3');
    Route::get('getNumLead/{identificationNumber}', 'Admin\MotosController@getNumLead');
    Route::get('validationLead/{identificationNumber}', 'Admin\MotosController@validationLead');
    Route::get('getCodeVerification/{identificationNumber}/{celNumber}/{type}', 'Admin\MotosController@getCodeVerificationOportudata');
    Route::get('verificationCode/{code}/{identificationNumber}', 'Admin\MotosController@verificationCode');
    Route::post('saveMotoLead','Admin\MotosController@storeData');
    Route::get('encryptText/{string}','Admin\MotosController@encrypt');
    
});

Route::group(['prefix'=>'/motos/simulador/'],function(){
    
    Route::get('getData/{idMoto}','Admin\MotosController@getDataLiquidator');

});

Route::resource('adminMotos','Admin\MotosAdminController');


Route::group(['prefix'=>'/admin/motos/'],function(){
    Route::get('/',function(){
        return view('motos.adminMotos.index');
    });
    Route::get('/leads',function(){
        return view('motos.adminMotos.leads');
    });

    Route::put('addImage/{idMoto}','Admin\MotosAdminController@storeImageMoto');

});
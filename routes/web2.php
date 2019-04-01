<?php 

//libranza routes

Route::resource('libranzaV2','Admin\LibranzaV2Controller');

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

Route::get('/OPN_gracias_denied_advance',function(){
    return view('advance.pageDeniedAdvance');
})->name('thankYouPageAdvanceDenied');

//Route::get('/getDataLibranza','Admin\LibranzaController@getData');

Route::group(['prefix'=>'/libranza-principal/'],function(){
    Route::get('/', function(){
        return view('libranza.index');
    });
    Route::get('/libranza-lines',function(){
        return view('libranza.libranza');
    });
});

Route::resource('simulator','Admin\SimulatorController');
Route::get('simulador/getDataSimulador','Admin\SimulatorController@getData');
Route::post('/createPagaduria','Admin\SimulatorController@addPagaduria');

Route::group(['prefix'=>'/simulador/'],function(){     
    Route::get('/','Admin\SimulatorController@index'); 

    Route::get('/pagaduria',function(){
        return view('simulator.pagaduria.pagaduria');
    });
    Route::get('/parametros', function(){
        return view('simulator.parameters.parameters');
    });
   
});

Route::get('/getDataLibranza','Admin\LibranzaController@getData');

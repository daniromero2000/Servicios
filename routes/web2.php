<?php 

//libranza routes

Route::resource('libranzaV2','Admin\LibranzaV2Controller');

Route::group(['prefix'=>'/creditoLibranza/'],function(){

    Route::get('/step1', 'Admin\LibranzaV2Controller@step1')->name('step1Libranza');
    Route::get('/getDataStep2/{numIdentification}','Admin\LibranzaV2Controller@getDataStep2');
    Route::get('/getDataStep3/{numIdentification}','Admin\LibranzaV2Controller@getDataStep3');
    Route::post('/saveStep1','Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::post('/saveStep2','Admin\LibranzaV2Controller@store')->name('libranza.saveStep1');
    Route::get('/step2/{numIdentification}', 'Admin\LibranzaV2Controller@step2')->name('libranzaStep2');
    Route::get('/step3/{numIdentification}', 'Admin\LibranzaV2Controller@step3')->name('libranzaStep3');
    Route::get('/encryptText/{string}','Admin\LibranzaV2Controller@encrypt');

})  ;

Route::resource('avance','Admin\AdvanceController');

Route::get('/OPN_gracias_denied_advance',function(){
    return view('oportuya.pageDeniedAdvance');
})->name('thankYouPageAdvanceDenied');
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('libranzaV2','Admin\LibranzaV2Controller');
Route::get('/getPagadurias/{idProfile}','Admin\LibranzaController@assignPagaduria');
Route::get('/getDataLibranza','Admin\LibranzaController@getData');
Route::get('/admin/getDataLibranza','Admin\LibranzaController@libranzaData');
/*Route::get('/getDataSimulator','Admin\SimulatorController@getData');
Route::put('/updateSimulator','Admin\SimulatorController@update');*/

/*Route::group(['prefix'=>'/creditoLibranza/'],function(){

    Route::get('/step1','Admin\LibranzaV2Controller@step1')->name('step1Libranza');
    Route::get('/getDataStep1/{numIdentification}','Admin\LibranzaV2Controller@getDataStep1');
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

})  ;*/
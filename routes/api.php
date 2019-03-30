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
Route::put('/addAmount/{idLead}','Admin\LibranzaController@addAmount');
Route::put('/updateLiquidator/{idLead}','Admin\LibranzaController@updateLiquidator');
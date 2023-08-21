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

Route::any('payment/status', 'OrderController@paymentCallback');
Route::any('payment/subscribecancel', 'OrderController@subscribecancel');
// Route::post('payment/status', 'OrderController@paymentCallback');

// Route::get('payment/statusCheck', 'OrderController@statusCheck');
Route::get('payment/viewpdfwork', 'OrderController@viewpdfwork');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

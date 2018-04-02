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

/** Using the variable {product}, is possible to use implicit route
 * model binding which makes easier the query for a 
 * specific product ID inside the controller
*/
Route::get('products','ProductController@index');
Route::get('products/{product}','ProductController@show');
Route::post('products','ProductController@store');
Route::put('products/{product}','ProductController@update');
Route::delete('products/{product}','ProductController@delete');


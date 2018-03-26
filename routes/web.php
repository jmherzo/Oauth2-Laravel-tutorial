<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/product', 'Admin\\ProductController');
Route::resource('admin/section', 'Admin\\SectionController');
Route::resource('admin/privileges', 'Admin\\PrivilegesController');
Route::resource('admin/policies', 'Admin\\PoliciesController');
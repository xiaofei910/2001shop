<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('admin')->namespace('Admin')->group(function (){
    ################################# 品牌 ###################################
    Route::get('/','IndexController@index');
    Route::get('/brand/create','BrandController@create')->name('brand.create');
    Route::post('/brand/store','BrandController@store');
    Route::get('/brand','BrandController@index')->name('brand');
    Route::any('/brand/upload','BrandController@upload');
    Route::get('/brand/edit/{brand_id}','BrandController@edit')->name('brand.edit');
    Route::post('/brand/update/{brand_id}','BrandController@update');
    Route::any('/brand/brandjd','BrandController@brandjd');
    Route::any('/brand/destroy','BrandController@destroy');
    Route::any('/brand/destroys','BrandController@destroys');
    ################################# 品牌 ###################################
});

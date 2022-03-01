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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Products Routes
Route::get('products','ProductController@getAllProducts')->name('products');
// Route::get('detail/{id}','ProductController@getDetail')->name('detail');
Route::post('add_to_cart','ProductController@addToCart')->name('add-to-cart');
Route::post('remove_from_cart','ProductController@removeFromCart')->name('remove-from-cart');
Route::get('add_product','ProductController@addProduct')->name('add_product');
Route::post('save_product','ProductController@saveProduct')->name('save_product');

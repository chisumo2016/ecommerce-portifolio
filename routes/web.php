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

Route::get('/', 'MainController@index')->name('main');

Route::get('profile','ProfileController@edit')->name('profile.edit');
Route::put('profile','ProfileController@update')->name('profile.update');

Route::Resource('carts','CartController')->only(['index']);
Route::Resource('orders','OrderController')
    ->only(['create','store'])
    ->middleware(['verified']);

Route::Resource('products.carts','ProductCartController')->only(['store','destroy']);
Route::Resource('orders.payments','OrderPaymentController')
    ->only(['create','store'])
    ->middleware(['verified']);


Auth::routes([  //Support/Facades/Auth
    'verify' => true,
    //'reset' => true,
]);

//Route::get('/home', 'HomeController@index')->name('home');



/*Route::get('products','ProductController@index')->name('products.index');

Route::get('products/create','ProductController@create')->name('products.create');

Route::post('products', 'ProductController@store')->name('products.store');

Route::get('products/{product}','ProductController@show')->name('products.show');

Route::get('products/{product}/edit','ProductController@edit')->name('products.edit');

Route::match(['put', 'patch'],   'products/{product}/edit','ProductController@update')->name('products.update');

Route::delete("products/{product}",  'ProductController@destroy')->name('products.destroy');*/




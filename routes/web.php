<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth'])->group(function () {



    Route::get('/home', 'HomeController@index')->name('home');

    // Rents
    Route::resource('rents', 'RentsController');

    // customers
    Route::resource('customers', 'CustomersController');

    // products
    Route::resource('products', 'ProductsController');

});

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();



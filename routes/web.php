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

Auth::routes();

Route::middleware('auth')
    ->namespace('Owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/home', 'HomeController@main')->name('home');
        Route::resource('restaurants', 'RestaurantController');
        Route::resource('calendar','CalendarController', [
            'except' => ['index', 'create']
        ]);
        Route::get('{id}/calendar', 'CalendarController@create')->name('calendar.create');
        Route::resource('dish', 'DishController', [
            'except' => ['index', 'create']
        ]);
        Route::get('{id}/dishes', 'DishController@index')->name('dish.index');
        Route::get('{id}/dish/create', 'DishController@create')->name('dish.create');
});

Route::get('{slug}/order-confirm', 'PaymentController@goCheckout');
Route::get('{slug}/checkout', 'PaymentController@prepareCheckout');
Route::post('/checkout', 'PaymentController@doCheckout');

Route::get('{any?}', 'HomeController@main')->where('any', '.*')->name('home');
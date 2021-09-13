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
        Route::resource('admin/restaurants', 'RestaurantController');
        Route::resource('calendar','CalendarController', [
            'except' => ['index', 'create']
        ]);
        Route::get('/admin/orders', 'OrderController@index')->name('order.index');
        Route::get('/admin/{order}/order', 'OrderController@show')->name('order.show');
        Route::get('{id}/calendar', 'CalendarController@create')->name('calendar.create');
        Route::resource('dish', 'DishController', [
            'except' => ['index', 'create']
        ]);
        Route::get('{id}/dishes', 'DishController@index')->name('dish.index');
        Route::get('{id}/dish/create', 'DishController@create')->name('dish.create');
});

Route::get('order-confirm', 'PaymentController@goCheckout');
Route::post('/checkout', 'PaymentController@doCheckout');

Route::get('{any?}', 'HomeController@main')->where('any', '.*')->name('home');
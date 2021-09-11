<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')
    ->name('api.')
    ->group(function() {
        Route::get('{slug}/get-restaurant', 'RestaurantController@getRestaurant');
        Route::get('dish-categories', 'RestaurantController@getDishCategories');
        Route::get('restaurants', 'RestaurantController@getRestaurants');
        Route::get('restaurant-types', 'RestaurantController@getRestaurantTypes');
        Route::post('search-restaurants', 'QueryController@searchRestaurants');
    });
    
Route::post('{slug}/checkout', 'PaymentController@prepareCheckout');
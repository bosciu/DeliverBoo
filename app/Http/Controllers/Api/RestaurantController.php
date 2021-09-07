<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use App\DishCategory;
use App\RestaurantType;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestaurant($slug){
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();
        return response()->json($restaurant);
    }

    public function getDishCategories(){
        $dishCategories = DishCategory::all();
        return response()->json($dishCategories);
    }

    public function getRestaurants(){
        $restaurants = Restaurant::all();
        return response()->json($restaurants);
    }

    public function getRestaurantTypes(){
        $restaurantTypes = RestaurantType::all();
        return response()->json($restaurantTypes);
    }
    
}

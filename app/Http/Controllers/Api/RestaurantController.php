<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Dish;
use App\Restaurant;
use App\DishCategory;
use App\RestaurantType;
use Illuminate\Support\Arr;


use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getRestaurant($slug){
        $restaurant = Restaurant::where('slug', $slug)->with('address','calendar')->firstOrFail();
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        $categoriesId = [];
        $categories = [];
       
        foreach($dishes as $dish) {
            if(!in_array($dish->dish_category_id,$categoriesId)) {
                $categoriesId[]=$dish->dish_category_id;
                $categories[$dish->dishCategory->name]=$dish->dishCategory;
            }
        }

        $restaurant['dishes'] = $dishes;
        $restaurant['dish_categories'] = $categories;

        $restaurant->restaurantTypes;

        return response()->json($restaurant);
    }

    public function getDishCategories(){
        $dishCategories = DishCategory::all();
        return response()->json($dishCategories);
    }

    public function getRestaurants(){
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            foreach ($restaurant->restaurantTypes as $restaurantType) {
                $restaurant->restaurantTypes[] = $restaurantType->id;
            }
        }

        return response()->json($restaurants);
    }

    public function getRestaurantTypes(){
        $restaurantTypes = RestaurantType::all();
        return response()->json($restaurantTypes);
    }
    
}

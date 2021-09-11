<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function searchRestaurants(Request $request){
        $queryString  = $request->all();
        if(strlen($queryString['query']) > 0){
            $restaurants = Restaurant::where('name', 'like', $queryString['query'].'%')->get();
        }else{
            $restaurants = [];
        }
        return response()->json($restaurants);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantType extends Model
{
    public function restaurants() {
        return $this->hasMany('App\Restaurant','restaurants_restaurant_types');
    }
}

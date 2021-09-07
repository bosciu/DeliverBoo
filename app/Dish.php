<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'dish_category_id',
        'restaurant_id',
        'name',
        'desc',
        'modular',
        'price',
        'vegetarian',
        'vegan',
        'lunch_available',
        'dinner_available',
        'img_path'
    ];

    public function dishCategory() {
        return $this->belongsTo('App\DishCategory');
    }

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }
}
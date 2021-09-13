<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'calendar_id',
        'name',
        'email',
        'phone',
        'slug',
        'img_path',
        'take_away',
        'free_delivery',
        'delivery_price'
        
    ];

    public function owner() {
        return $this->belongsTo('App\Owner');
    }

    public function address() {
        return $this->belongsTo('App\Address');
    }

    public function restaurantTypes() {
        return $this->belongsToMany('App\RestaurantType','restaurants_restaurant_types');
    }

    public function calendar() {
        return $this->belongsTo('App\Calendar');
    }

    public function dishes() {
        return $this->hasMany('App\Dish');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }
}

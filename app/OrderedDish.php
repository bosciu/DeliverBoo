<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedDish extends Model
{
    protected $table = "ordered_dishes";

    public function dish(){
        return $this->belongsTo('App\Dish');
    }

    public function orders(){
        return $this->belongsTo('App\Order');
    }
}

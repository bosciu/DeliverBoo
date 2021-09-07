<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
        'restaurant_id',
        'address_id',
        'name',
        'surname',
        'total',
        'payment_status',
        'payment_provider'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function address(){
        return $this->hasOne('App\Address');
    }

    public function dishes(){
        return $this->belongsToMany('App\Dish');
    }

}

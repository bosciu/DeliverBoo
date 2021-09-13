<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address',
        'city',
        'zip_code',
        'province',
        'country'
    ];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function restaurant() {
        return $this->hasOne('App\Restaurant');
    }

    public function order() {
        return $this->hasOne('App\Order');
    }
}

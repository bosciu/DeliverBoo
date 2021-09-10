<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Address;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = config('restaurant');
        $addresses = config('address');
        foreach ($addresses as $address) {
            $newAddress = new Address();
            $newAddress->address = $address['address'];
            $newAddress->city = $address['city'];
            $newAddress->zip_code = $address['zip_code'];
            $newAddress->province = $address['province'];
            $newAddress->country = $address['country'];
            $newAddress->save();
        }
        for ($i=0; $i < count($restaurants); $i++) { 
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $restaurants[$i]['user_id'];
            $newRestaurant->address_id = $restaurants[$i]['address_id'];
            $newRestaurant->name = $restaurants[$i]['name'];
            $newRestaurant->email = $restaurants[$i]['email'];
            $newRestaurant->phone = $restaurants[$i]['phone'];
            $newRestaurant->slug = $restaurants[$i]['slug'];
            $newRestaurant->take_away = $restaurants[$i]['take_away'];
            $newRestaurant->free_delivery = $restaurants[$i]['free_delivery'];
            $newRestaurant->delivery_price = $restaurants[$i]['delivery_price'];
            $newRestaurant->img_path = $restaurants[$i]['img_path'];
            $newRestaurant->save();
            foreach ($restaurants[$i]['restaurant_type'] as $type) {
                $newRestaurant->restaurantTypes()->attach($type);
            }
        }
    }
}

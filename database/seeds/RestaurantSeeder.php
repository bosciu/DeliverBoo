<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newRestaurant = new Restaurant();
        $newRestaurant->user_id = 21;
        $newRestaurant->address_id = 2;
        $newRestaurant->name = "Da Mario";
        $newRestaurant->email = "damario@mario.it";
        $newRestaurant->phone = "23232323";
        $newRestaurant->slug = "da-mario";
        $newRestaurant->take_away = 0;
        $newRestaurant->free_delivery = 0;
        $newRestaurant->delivery_price = 5;
        $newRestaurant->img_path = "storage/prova.jpg";
        $newRestaurant->save();
    }
}

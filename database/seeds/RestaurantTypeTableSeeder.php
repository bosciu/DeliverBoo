<?php

use Illuminate\Database\Seeder;
use App\RestaurantType;

class RestaurantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('restaurantTypes');
        foreach ($types as $type) {
            $newRestaurantType = new RestaurantType();
            $newRestaurantType->name = $type['name'];
            $newRestaurantType->img_path = $type['img_path'];
            $newRestaurantType->save();
        }
    }
}
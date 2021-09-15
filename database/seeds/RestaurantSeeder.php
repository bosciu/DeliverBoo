<?php

use Illuminate\Database\Seeder;
use App\Restaurant;
use App\Address;
use App\Calendar;

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
        $calendars = config('calendar');
        foreach ($calendars as $calendar) {
            $newCalendar = new Calendar();
            $newCalendar->mon = $calendar['mon'];
            $newCalendar->tue = $calendar['tue'];
            $newCalendar->wed = $calendar['wed'];
            $newCalendar->thu = $calendar['thu'];
            $newCalendar->fri = $calendar['fri'];
            $newCalendar->sat = $calendar['sat'];
            $newCalendar->sun = $calendar['sun'];
            $newCalendar->save();
        }
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
            $newRestaurant->calendar_id = $restaurants[$i]['calendar_id'];
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
        $adminRestaurantAddress = new Address();
            $adminRestaurantAddress->address = 'Via Milano 17';
            $adminRestaurantAddress->city = 'Corsico Italia';
            $adminRestaurantAddress->zip_code = '20144';
            $adminRestaurantAddress->province = 'MI';
            $adminRestaurantAddress->save();

        $adminRestaurant = new Restaurant();
        $adminRestaurant->user_id = 27;
        $adminRestaurant->address_id = $adminRestaurantAddress->id;
        $adminRestaurant->name = 'Da Mario';
        $adminRestaurant->email = 'damario@gmail.com';
        $adminRestaurant->phone = '3336536178';
        $adminRestaurant->slug = 'da-mario';
        $adminRestaurant->take_away = 1;
        $adminRestaurant->free_delivery = 0;
        $adminRestaurant->delivery_price = 3.50;
        $adminRestaurant->img_path = 'restaurant_image/da-mario.jpg';
        $adminRestaurant->save();

        $adminRestaurantAddress = new Address();
            $adminRestaurantAddress->address = 'Via Piacenza 22';
            $adminRestaurantAddress->city = 'Piacenza';
            $adminRestaurantAddress->zip_code = '20120';
            $adminRestaurantAddress->province = 'PC';
            $adminRestaurantAddress->save();

        $adminRestaurant = new Restaurant();
        $adminRestaurant->user_id = 27;
        $adminRestaurant->address_id = $adminRestaurantAddress->id;
        $adminRestaurant->name = 'Ravioleria Piacenza';
        $adminRestaurant->email = 'ravioleria@mail.com';
        $adminRestaurant->phone = '3336575647';
        $adminRestaurant->slug = 'ravioleria-piacenza';
        $adminRestaurant->take_away = 0;
        $adminRestaurant->free_delivery = 1;
        $adminRestaurant->delivery_price = 0;
        $adminRestaurant->img_path = 'restaurant_image/gastronomia_yamamoto.jpeg';
        $adminRestaurant->save();
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SuperAdmin::class);
        $this->call(RestaurantTypeTableSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(DishCategorySeeder::class);
        $this->call(DishTableSeeder::class);
    }
}

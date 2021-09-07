<?php

use Illuminate\Database\Seeder;
use App\DishCategory;

class DishCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishcategories = config('dishCategories');
        foreach ($dishcategories as $dishCategory) {
            $newDishCategory = new DishCategory();
            $newDishCategory->name = $dishCategory;
            $newDishCategory->save();
        }
    }
}

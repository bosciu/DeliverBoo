<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_category_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('name',100);
            $table->text('desc',1000);
            $table->float('price',5,2);
            $table->boolean('vegetarian')->default(false);
            $table->boolean('vegan')->default(false);
            $table->boolean('lunch_available')->default(true);
            $table->boolean('dinner_available')->default(true);
            $table->string('img_path',100)->nullable();
            $table->boolean('hidden')->default(false);
            $table->timestamps();

            $table->foreign('dish_category_id')->references('id')->on('dish_categories');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}

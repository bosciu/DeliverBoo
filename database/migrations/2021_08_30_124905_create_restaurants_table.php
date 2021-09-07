<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('calendar_id')->nullable();
            $table->string('name', 100);
            $table->string('email', 60);
            $table->string('phone', 15);
            $table->string('slug', 100);
            $table->boolean('take_away')->default(false);
            $table->boolean('free_delivery')->default(false);
            $table->float('delivery_price',4,2);
            $table->string('img_path',100);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('CASCADE');
            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('SET NULL');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}

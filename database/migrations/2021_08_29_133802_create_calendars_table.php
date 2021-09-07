<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('mon',30)->nullable();
            $table->string('tue',30)->nullable();
            $table->string('wed',30)->nullable();
            $table->string('thu',30)->nullable();
            $table->string('fri',30)->nullable();
            $table->string('sat',30)->nullable();
            $table->string('sun',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}

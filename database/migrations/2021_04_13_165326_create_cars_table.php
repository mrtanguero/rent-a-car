<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_title');
            $table->string('plate_number');
            $table->year('production_year');
            $table->foreignId('car_class_id')->constrained('car_classes');
            $table->integer('number_of_seats');
            $table->integer('price_per_day');
            $table->string('photo_url');
            $table->text('additional_notes');
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
        Schema::dropIfExists('cars');
    }
}

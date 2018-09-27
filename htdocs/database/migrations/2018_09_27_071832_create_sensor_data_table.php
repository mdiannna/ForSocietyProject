<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('building_id')->nullable();
            $table->boolean('collapsed')->nullable()->default(0);
            $table->json('location_details')->nullable();
            $table->decimal('temperature')->nullable();
            $table->decimal('pressure')->nullable();
            $table->decimal('acceleration')->nullable();
            $table->timestamp('collected_time')->nullable();
            $table->timestamp('received_time')->nullable();


            $table->foreign('building_id')->references('id')->on('buildings');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_data');
    }
}

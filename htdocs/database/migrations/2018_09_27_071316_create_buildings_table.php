<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->decimal('lat', 15, 10)->nullable();
            $table->decimal('lng', 15, 10)->nullable();
            $table->integer('year_built')->nullable();
            $table->integer('risk_class')->nullable();
            $table->string('height_type')->nullable();
            $table->integer('nr_apartments')->nullable();
            $table->integer('nr_people')->nullable();
            $table->decimal('surface')->nullable();
            $table->integer('year_expertise')->nullable();
            $table->string('expert')->nullable();
            $table->text('details')->nullable();

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
        Schema::dropIfExists('buildings');
    }
}

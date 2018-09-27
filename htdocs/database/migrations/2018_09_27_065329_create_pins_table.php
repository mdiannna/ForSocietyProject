<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address')->nullable();
            $table->text('details')->nullable();
            $table->string('lat');
            $table->string('lng');
            $table->integer('status');
            $table->unsignedInteger('pin_type_id')->nullable();
            $table->unsignedInteger('badge_type_id')->nullable();
            $table->timestamps();

            $table->foreign('pin_type_id')->references('id')->on('pin_types');
            $table->foreign('badge_type_id')->references('id')->on('badges');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pins');
    }
}

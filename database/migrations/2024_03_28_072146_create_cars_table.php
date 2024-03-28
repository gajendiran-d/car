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
            $table->string('user_id', 10);
            $table->string('brand', 75)->nullable();
            $table->string('model', 75)->nullable();
            $table->string('color', 75)->nullable();
            $table->integer('year')->nullable();
            $table->string('image', 100)->nullable();
            $table->string('address', 750)->nullable();
            $table->string('latitude', 750)->nullable();
            $table->string('longitude', 750)->nullable();
            $table->smallInteger('active_status', false, true)->length(1);
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

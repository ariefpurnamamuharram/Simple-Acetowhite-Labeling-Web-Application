<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageAreaMarksMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_area_marks', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 100);
            $table->integer('rect_x0');
            $table->integer('rect_y0');
            $table->integer('rect_x1');
            $table->integer('rect_y1');
            $table->integer('label');
            $table->string('description');
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
        Schema::dropIfExists('image_area_marks');
    }
}

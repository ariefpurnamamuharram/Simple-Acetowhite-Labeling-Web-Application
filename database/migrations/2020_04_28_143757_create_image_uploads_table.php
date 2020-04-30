<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename_pre_iva', 100);
            $table->string('path_pre_iva');
            $table->string('filename_post_iva', 100);
            $table->string('path_post_iva');
            $table->string('posted_by');
            $table->string('edited_by');
            $table->integer('label');
            $table->string('comment');
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
        Schema::dropIfExists('image_uploads');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageArtifactsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_artifacts', function (Blueprint $table) {
            $table->id();
            $table->string('filename', 100);
            $table->boolean('cbMetaplasiaRing');
            $table->boolean('cbIUD');
            $table->boolean('cbMenstrualBlood');
            $table->boolean('cbSlime');
            $table->boolean('cbFluorAlbus');
            $table->boolean('cbCervicitis');
            $table->boolean('cbCarcinoma');
            $table->boolean('cbPolyp');
            $table->boolean('cbOvulaNabothi');
            $table->boolean('cbEctropion');
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
        Schema::dropIfExists('image_artifacts');
    }
}

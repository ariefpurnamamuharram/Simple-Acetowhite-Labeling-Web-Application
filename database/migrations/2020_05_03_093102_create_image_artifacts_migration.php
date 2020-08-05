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
            $table->string('filename');
            $table->string('email');
            $table->boolean('cbMetaplasiaRing')->default(false);
            $table->boolean('cbIUD')->default(false);
            $table->boolean('cbMenstrualBlood')->default(false);
            $table->boolean('cbSlime')->default(false);
            $table->boolean('cbFluorAlbus')->default(false);
            $table->boolean('cbCervicitis')->default(false);
            $table->boolean('cbPolyp')->default(false);
            $table->boolean('cbOvulaNabothi')->default(false);
            $table->boolean('cbEctropion')->default(false);
            $table->boolean('cbReflections')->default(false);
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

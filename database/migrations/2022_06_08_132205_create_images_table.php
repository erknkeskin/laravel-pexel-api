<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('photo_id');
            $table->string('pexel_original');
            $table->string('pexel_large2x');
            $table->string('pexel_large');
            $table->string('pexel_medium');
            $table->string('pexel_small');
            $table->string('pexel_portrait');
            $table->string('pexel_landscape');
            $table->string('pexel_tiny');
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
        Schema::dropIfExists('images');
    }
}

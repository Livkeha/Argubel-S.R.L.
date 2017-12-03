<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('picture_number');
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('project_pictures');
    }
}

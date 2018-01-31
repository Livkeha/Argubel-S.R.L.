<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('documento')->unique();
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('rol');
            $table->string('monto_establecido')->nullable();
            $table->integer('dia_vencimiento')->nullable();
            $table->string('mes_vencimiento')->nullable();
            $table->integer('anio_vencimiento')->nullable();
            $table->integer('balance')->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->boolean('primer_logueo')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

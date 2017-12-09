<?php

use Carbon\Carbon;

$date = Carbon::now();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes')->nullable();
            $table->integer('anio')->nullable();
            $table->integer('monto_establecido')->nullable();
            $table->integer('dia_vencimiento')->nullable();
            $table->string('mes_vencimiento')->nullable();
            $table->integer('anio_vencimiento')->nullable();
            $table->integer('monto_pagado')->nullable();
            $table->integer('dia_pagado')->nullable();
            $table->string('mes_pagado')->nullable();
            $table->integer('anio_pagado')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('balances');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstadisticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('equipo_id')->unsigned()->nullable();
            $table->integer('idtorneo')->unsigned()->nullable();
            $table->integer('pj')->nullable();
            $table->integer('pg')->nullable();
            $table->integer('pp')->nullable();
            $table->integer('pts')->nullable();
            $table->foreign('equipo_id')->references('id')->on('programacions')->nullable();
            $table->foreign('idtorneo')->references('id')->on('programacions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estadisticas');
    }
}

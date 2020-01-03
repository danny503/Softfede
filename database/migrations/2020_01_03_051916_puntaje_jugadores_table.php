<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuntajeJugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntaje_jugadores', function (Blueprint $table){
            $table->increments('id');
            $table->integer('puntaje');
            $table->integer('falta');
            $table->integer('idpro_partido')->unsigned();
            $table->foreign('idpro_partido')->references('id')->on('pro_partidos');
            $table->integer('idjugador')->unsigned();
            $table->foreign('idjugador')->references('id')->on('jugadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntaje_jugadores');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallePartidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_partido',function (Blueprint $table){
            $table->increments('id');            
            $table->integer('puntaje');
            $table->integer('falta');
            $table->integer('idpuntaje_partido')->unsigned();
            $table->integer('idpro_partido')->unsigned();
            $table->integer('idjugador')->unsigned();
            $table->foreign('idjugador')->references('id')->on('jugadores');
            $table->foreign('idpuntaje_partido')->references('id')->on('puntaje_partido');
            $table->foreign('idpro_partido')->references('id')->on('pro_partidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_partido');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetallePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_partidos',function (Blueprint $table){
            $table->increments('id');            
            $table->integer('puntaje');
            $table->integer('falta');
            $table->integer('idpuntaje_partido')->unsigned();
            $table->foreign('idpuntaje_partido')->references('id')->on('puntaje_partido');
            //$table->integer('idpro_partido')->unsigned();            
           // $table->foreign('idpro_partido')->references('id')->on('pro_partidos');
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
        Schema::dropIfExists('detalle_partidos');
    }
}

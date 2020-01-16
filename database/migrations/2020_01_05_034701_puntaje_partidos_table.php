<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuntajePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntaje_partidos',function (Blueprint $table){
            $table->increments('id');
            $table->integer('punto_a');
            $table->integer('punto_b');
            $table->string('ganador');
            $table->integer('idpro_partido')->unsigned();
            $table->foreign('idpro_partido')->references('id')->on('programacions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntaje_partidos');
    }
}

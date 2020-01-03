<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PuntajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntajes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('equipo_a');
            $table->integer('equipo_b');
            $table->string('ganador');
            $table->integer('idinscripcionje')->unsigned();
            $table->foreign('idinscripcionje')->references('id')->on('inscripcionje');
            $table->integer('idpro_partido')->unsigned();
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
        Schema::dropIfExists('puntajes');
    }
}

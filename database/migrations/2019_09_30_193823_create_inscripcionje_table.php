<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionjeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcionje', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->date('fecha_ingreso')->nullable();
            $table->integer('numero_camisa');
            $table->char('posicion',80);
            $table->integer('idjugador')->unsigned();
            $table->foreign('idjugador')->references('id')->on('jugadores');

            $table->integer('idequipo')->unsigned();
            $table->foreign('idequipo')->references('id')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcionje');
    }
}

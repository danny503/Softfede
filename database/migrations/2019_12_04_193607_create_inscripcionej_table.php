<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscripcionejTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripcionej', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idequipo')->unsigned();
            $table->foreign('idequipo')->references('id')->on('equipos');
            $table->integer('idjugador')->unsigned();
            $table->foreign('idjugador')->references('id')->on('jugadores');            
            $table->integer('numero_camisa');
            $table->char('posicion',80);
            $table->date('fecha_ingreso')->nullable();
            

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscripcionej');
    }
}

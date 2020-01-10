<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramacionPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacion_partidos', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('jornada');
        $table->integer('equipo_a')->unsigned();
        $table->integer('equipo_b')->unsigned();
        $table->foreign('equipo_a')->references('id')->on('detalle_torneos');
        $table->foreign('equipo_b')->references('id')->on('detalle_torneos');        
        $table->integer('iddetalle_torneo')->unsigned();
        $table->foreign('iddetalle_torneo')->references('id')->on('detalle_torneos'); 
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
        Schema::dropIfExists('programacion_partidos');
    }
}

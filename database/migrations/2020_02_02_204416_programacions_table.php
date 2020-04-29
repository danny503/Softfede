<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProgramacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jornada')->nullable();
            $table->integer('equipo_a')->unsigned()->nullable();
            $table->integer('equipo_b')->unsigned()->nullable();
            $table->foreign('equipo_a')->references('id')->on('detalle_torneos')->nullable();
            $table->foreign('equipo_b')->references('id')->on('detalle_torneos')->nullable();        
            $table->integer('idtorneo')->unsigned()->nullable();
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->integer('idsede')->unsigned()->nullable();
            $table->foreign('idsede')->references('id')->on('sedes')->nullable();
            $table->foreign('idtorneo')->references('id')->on('detalle_torneos')->nullable();
            $table->integer('puntaje_a')->nullable();
            $table->integer('puntaje_b')->nullable();
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
        Schema::dropIfExists('programacions');
    }
   
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProPartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pro_partidos', function (Blueprint $table) {
        $table->increments('id');
        $table->string('hora');
        $table->date('fecha');
        $table->integer('num_partido');
        $table->integer('equipo_a')->unsigned();
        $table->integer('equipo_b')->unsigned();
        $table->foreign('equipo_a')->references('id')->on('detalle_torneos');
        $table->foreign('equipo_b')->references('id')->on('detalle_torneos');
        $table->integer('idsede')->unsigned();
        $table->foreign('idsede')->references('id')->on('sedes');
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
    Schema::dropIfExists('pro_partidos');
}
}


<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetalleTorneosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_torneos', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('idequipo')->unsigned();
        $table->foreign('idequipo')->references('id')->on('equipos');
        $table->integer('idtorneo')->unsigned();
        $table->foreign('idtorneo')->references('id')->on('torneos');  
        
            
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_torneos');
    }
}

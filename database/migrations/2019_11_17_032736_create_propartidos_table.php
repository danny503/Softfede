<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propartidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idsede')->unsigned();
            $table->time('hora');
            $table->date('fecha');
            $table->string('equipo_a', 50);
            $table->string('equipo_b', 50);
            $table->foreign('idsede')->references('id')->on('sedes');
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
        Schema::dropIfExists('propartidos');
    }
}

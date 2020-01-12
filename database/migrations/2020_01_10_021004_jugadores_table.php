<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JugadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->double('estatura')->nullable();
            $table->string('foto',100)->nullable();              
            $table->foreign('id')->references('id')->on('personas')->onDelete('cascade'); 
            $table->integer('idusuario')->unsigned();
            $table->foreign('idusuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}

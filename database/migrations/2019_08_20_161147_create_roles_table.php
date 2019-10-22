<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',30)->unique();
        });
        DB::table('roles')->insert(array('id'=>'1','nombre'=>'Administrador'));
        DB::table('roles')->insert(array('id'=>'2','nombre'=>'Jugador'));
        DB::table('roles')->insert(array('id'=>'3','nombre'=>'Tecnico'));
        DB::table('roles')->insert(array('id'=>'4','nombre'=>'Arbitro'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

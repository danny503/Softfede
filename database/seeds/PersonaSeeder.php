<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('personas')->truncate();
        DB::table('personas')->insert([
            'id'=> 1,
            'nombre' => 'Angel Serrano',
            'fechanac' => '1995-12-10',
            'genero' => 'Masculino',
            'direccion' => 'Chalatenango',
            'telefono'=> '78963652',
            'email'=> 'angel@gmail.com',
            ]);
    }
}

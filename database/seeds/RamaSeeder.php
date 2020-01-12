<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class RamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('ramas')->truncate();
        Db::table('ramas')->insert([
            'nombre'=> 'Masculino',            
        ]);
        Db::table('ramas')->insert([
            'nombre'=> 'Femenino',            
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id' => 1,
            'usuario' => 'administrador',
            'password' => bcrypt('12345'),
            'estado' => 1,
            'idrol' => 1,
        ]);
    }
}

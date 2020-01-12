<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdministradorSeeder::class);
         $this->call(PersonaSeeder::class);
         $this->call(RamaSeeder::class);
    }
}

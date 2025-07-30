<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            //EstadoSeeder::class,
           // HorarioSeeder::class
           //  ServicioSeeder::class 
           FichasDemoSeeder::class

        ]);
    }
}

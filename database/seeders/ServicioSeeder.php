<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        Servicio::updateOrCreate(
            ['codigo' => 'SRV-001'],
            ['nombre' => 'Apostillado']
        );

        Servicio::updateOrCreate(
            ['codigo' => 'SRV-002'],
            ['nombre' => 'Rejap']
        );
    }
}

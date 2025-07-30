<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioSeeder extends Seeder
{
    public function run()
    {
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

        foreach ($dias as $dia) {
            DB::table('horarios')->insert([
                'dia_semana' => $dia,
                'hora_inicio' => '08:00:00',
                'hora_fin' => '15:30:00',
            ]);
        }
    }
}

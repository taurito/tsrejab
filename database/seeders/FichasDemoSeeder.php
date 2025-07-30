<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichasDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener el ID del servicio (Apostillado)
        $servicio = DB::table('servicios')->where('codigo', 'SRV-001')->first();
        
        if (!$servicio) {
            $this->command->error('No se encontró el servicio SRV-001 (Apostillado)');
            return;
        }

        // Obtener el estado Pendiente
        $estado = DB::table('estados')->where('nombre', 'Pendiente')->first();
        
        if (!$estado) {
            $this->command->error('No se encontró el estado "Pendiente"');
            return;
        }

        $fecha = '2025-07-31';

        for ($i = 1; $i <= 300; $i++) {
            // Generar CI único (7 dígitos)
            $ci = 1000000 + $i;

            try {
                // Insertar persona
                $personaId = DB::table('personas')->insertGetId([
                    'nombre' => "Persona $i",
                    'ci' => $ci,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insertar ficha
                DB::table('fichas')->insert([
                    'persona_id' => $personaId,
                    'servicio_id' => $servicio->id,
                    'fecha_reserva' => $fecha,
                    'fecha_entrega' => Carbon::parse($fecha)->addDays(3),
                    'numero_ficha' => $i,
                    'estado_id' => $estado->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            } catch (\Exception $e) {
                $this->command->error("Error al insertar persona $i: " . $e->getMessage());
                continue;
            }
        }

        $this->command->info('Se han creado 300 fichas de demostración para la fecha: ' . $fecha);
    }
}
<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Horario;

class HorarioService
{
    public static function sePuedeReservarAhora(): bool
    {
        $ahora = Carbon::now();
        $dia = ucfirst($ahora->locale('es')->isoFormat('dddd')); // Ej: Lunes, Martes
        $horaActual = $ahora->format('H:i:s');

        $horario = Horario::where('dia_semana', $dia)->first();

        if (!$horario) {
            return false;
        }

        return $horaActual >= $horario->hora_inicio && $horaActual <= $horario->hora_fin;
    }
}

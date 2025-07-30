<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Ficha;

class ConsultaController extends Controller
{
    // Método para mostrar la vista inicial
    public function index()
    {
        return view('consulta.index'); // Muestra el formulario vacío
    }

    // Método para buscar por CI
    public function buscar(Request $request)
    {
        $request->validate([
           'ci' => ['required', 'numeric', 'digits_between:7,8'],
        ]);

        // Buscar persona
        $persona = Persona::where('ci', $request->ci)->first();

        if (!$persona) {
            return back()->with('error', 'No existe un registro con ese número de CI.');
        }

        // Buscar ficha más reciente
        $ficha = Ficha::where('persona_id', $persona->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$ficha) {
            return back()->with('error', 'No tienes ninguna ficha registrada.');
        }

        $estado = $ficha->estado->nombre;

        // Si no está Pendiente
        if ($estado !== 'Pendiente') {
            return back()->with('error', 'Tu ficha se encuentra en estado: ' . $estado);
        }

        // Si está Pendiente → mostrar datos y habilitar PDF
        return view('consulta.index', [
            'persona' => $persona,
            'ficha' => $ficha,
            'estado' => $estado,
            'mostrarPDF' => true // Bandera para el botón PDF
        ]);
    }
}

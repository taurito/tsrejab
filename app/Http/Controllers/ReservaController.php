<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\HorarioService;



class ReservaController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('reserva.index', compact('servicios'));
    }

   public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
         'ci' => ['required', 'numeric', 'digits_between:7,8'], //Esto permite 7 u 8 dígitos
        'fecha' => 'required|date',
        'servicio_id' => 'required|exists:servicios,id'
    ]);

    try {
        // Buscar o crear persona en caso que no exista
        $persona = \App\Models\Persona::firstOrCreate(
            ['ci' => $request->ci],
            ['nombre' => $request->nombre]
        );

        // Variables OUT para el SP
        DB::statement('SET @p_numero_ficha = 0');
        DB::statement('SET @p_estado = ""');

        // Llamar al procedimiento almacenado
        DB::statement('CALL generar_ficha(?, ?, ?, @p_numero_ficha, @p_estado)', [
            $request->servicio_id,
            $request->fecha,
            $persona->id
        ]);

        // Obtener valores de salida
        $resultado = DB::select('SELECT @p_numero_ficha AS numero_ficha, @p_estado AS estado')[0];

        // Validar resultado del SP
        if ($resultado->estado === 'YA_RESERVADO') {
            return back()->with('error', 'Ya tienes una ficha pendiente para este servicio.');
        }

        if ($resultado->estado === 'LIMITE_REBASADO') {
            return back()->with('error', 'No hay cupos disponibles para esta fecha.');
        }
        //Servicoo Horario
      //  if (!HorarioService::sePuedeReservarAhora()) {
    //return back()->with('error', 'Las reservas solo pueden realizarse dentro del horario de atención.');
//}

        // Caso OK
        return back()->with([
            'success' => 'Reserva registrada correctamente.',
            'numeroFicha' => $resultado->numero_ficha,
            'servicio' => \App\Models\Servicio::find($request->servicio_id)->nombre,
            'fecha' => $request->fecha,
            'nombre' => $request->nombre,
            'ci' => $request->ci
        ]);

    } catch (\Exception $e) {
        return back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
    }
}



public function fechasLlenas($id)
{
    // Aqui se obtienes las fechas desde la base de datos según el servicio
    // Si tienes tabla 'fichas' con columna 'fecha_reserva':
    $fechas = \DB::table('fichas')
        ->select('fecha_reserva')
        ->where('servicio_id', $id)
        ->groupBy('fecha_reserva')
        ->havingRaw('COUNT(*) >= 300') // Fechas con 300 o más registros
        ->pluck('fecha_reserva');

    return response()->json($fechas);
}
    
    public function exportPDF(Request $request)
{
    $data = [
        'numeroFicha' => $request->numero,
        'servicio' => $request->servicio,
        'fecha' => $request->fecha,
        'nombre' => $request->nombre,
        'ci' => $request->ci // Ya viene concatenado desde store()
    ];

    $pdf = Pdf::loadView('pdf.ficha', $data);
    return $pdf->download('Ficha-'.$request->numero.'.pdf');
}
}

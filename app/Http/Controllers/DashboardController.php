<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ficha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $hoy = Carbon::today(); // Fecha actual sin hora
    $fichas = Ficha::with('persona')
        ->whereDate('fecha_reserva', $hoy)
        ->get();

    return view('dashboard', compact('fichas'));
}
}

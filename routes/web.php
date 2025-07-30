<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ConsultaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/reserva', [ReservaController::class, 'index'])->name('reserva.index');
Route::post('/reserva', [ReservaController::class, 'store'])->name('reserva.store');

Route::get('/consulta', [ConsultaController::class, 'index'])->name('consulta.index');
Route::post('/consulta', [ConsultaController::class, 'buscar'])->name('consulta.buscar');


Route::get('/servicio/fechas-llenas/{id}', [ReservaController::class, 'fechasLlenas'])->name('servicio.fechasLlenas');
Route::get('/reserva/pdf', [App\Http\Controllers\ReservaController::class, 'exportPDF'])->name('reserva.pdf');

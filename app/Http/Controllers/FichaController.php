<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\Estado;

class FichaController extends Controller
{
    public function edit($id)
    {
        $ficha = Ficha::with('persona', 'estado')->findOrFail($id);
        $estados = Estado::all();

        return view('fichas.edit', compact('ficha', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado_id' => 'required|exists:estados,id',
        ]);

        $ficha = Ficha::findOrFail($id);
        $ficha->estado_id = $request->estado_id;
        $ficha->save();

        return redirect()->route('dashboard')->with('success', 'Estado actualizado correctamente.');
    }
}

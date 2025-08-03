@extends('layouts.app')

@section('title', 'Editar Ficha')

@section('content')
<div class="formulario-ficha">
    <h1>Editar estado de la ficha #{{ $ficha->id }}</h1>

    <p><strong>Persona:</strong> {{ $ficha->persona->nombre }}</p>
    <p><strong>Fecha de reserva:</strong> {{ \Carbon\Carbon::parse($ficha->fecha_reserva)->format('d/m/Y') }}</p>

    <form action="{{ route('fichas.update', $ficha->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <label for="estado_id" class="block font-semibold mb-2">Estado:</label>
        <select name="estado_id" id="estado_id" class="border px-4 py-2 rounded w-full">
            @foreach($estados as $estado)
                <option value="{{ $estado->id }}" {{ $ficha->estado_id == $estado->id ? 'selected' : '' }}>
                    {{ $estado->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Guardar cambios
        </button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Botón de cerrar sesión --}}
    <div class="flex justify-end mb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cerrar sesión
            </button>
        </form>
    </div>

    {{-- Título --}}
    <h1 class="text-xl font-bold">Fichas registradas hoy</h1>

    {{-- Tabla de fichas --}}
    @if($fichas->isEmpty())
        <p class="mt-4">No hay fichas registradas hoy.</p>
    @else
        <table class="tabla-fichas">
            <thead>
                <tr class="bg-gray-200">
                    <th>#</th>
                    <th>Persona</th>
                    <th>Fecha de reserva</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fichas as $ficha)
                    <tr>
                        <td>{{ $ficha->id }}</td>
                        <td>{{ $ficha->persona->nombre ?? 'Sin datos' }}</td>
                        <td>{{ \Carbon\Carbon::parse($ficha->fecha_reserva)->format('d/m/Y') }}</td>
                        <td>{{ $ficha->estado->nombre ?? 'Sin datos' }}</td>
                        <td>
                            <a href="{{ route('fichas.edit', $ficha->id) }}" class="boton">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

@section('scripts')
    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

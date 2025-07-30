@extends('layouts.app')

@section('content')
<div class="container">

    @if(session('error'))
        <div class="alert alert-danger" style="text-align:center; margin-top:15px;">
            {{ session('error') }}
        </div>
    @endif

    @if(isset($persona) && isset($ficha))
        <!-- Resultado de la búsqueda -->
        <div class="result-section" style="margin-top: 20px;">
            <h2>Resultado de la Búsqueda</h2>
            <p><strong>Nombre:</strong> {{ $persona->nombre }}</p>
            <p><strong>CI:</strong> {{ $persona->ci }}@if(!empty($persona->ci_ext))-{{ $persona->ci_ext }}@endif</p>
            <p><strong>Servicio:</strong> {{ $ficha->servicio->nombre }}</p>
            <p><strong>Fecha de Reserva:</strong> {{ $ficha->fecha_reserva }}</p>
            <p><strong>Número de Ficha:</strong> {{ $ficha->numero_ficha }}</p>
            <p><strong>Estado:</strong> {{ $estado }}</p>

            <div style="margin-top:15px; display:flex; gap:15px;">
                <!-- Botón Nueva búsqueda -->
                <a href="{{ route('consulta.index') }}" class="btn-consultar">Nueva Búsqueda</a>

                <!-- Mostrar botón PDF SOLO si está Pendiente -->
                @if($estado === 'Pendiente')
                    <a href="{{ route('reserva.pdf', [
                        'servicio' => $ficha->servicio->nombre,
                        'numero' => $ficha->numero_ficha,
                        'fecha' => $ficha->fecha_reserva,
                        'nombre' => $persona->nombre,
                        'ci' => $persona->ci
                    ]) }}" 
                    class="btn-consultar" style="background: #228B22; color:white;" target="_blank">
                        Descargar PDF
                    </a>
                @endif
            </div>
        </div>
    @else
        <!-- Formulario de búsqueda -->
        <div class="form-section">
            <h2>Consulta de Reserva</h2>
            <form method="POST" action="{{ route('consulta.buscar') }}">
                @csrf
                <div class="form-group">
                    <label for="ci">CI</label>
                    <input type="text" id="ci" name="ci" placeholder="Ingrese su CI" value="{{ old('ci') }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-consultar">Buscar</button>
                </div>
            </form>
        </div>
    @endif

    <!-- Logo -->
    <div class="logo-section">
        <img src="{{ asset('img/LogoSegundo.jpg') }}" alt="Logo Institucional">
    </div>
</div>
@endsection

<!--<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Cerrar sesión</button>
    </form>
<h1>hola como estas</h1>-->
<!DOCTYPE html>
<html lang="es">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - Consejo de la Magistratura</title>

        <!-- Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/estilos.css', 'resources/js/app.js'])
    </head>
    <body>
        <!-- Banner -->
    <div class="top-banner">
        <img src="{{ asset('img/menu123.jpg') }}" alt="Consejo de la Magistratura">
    </div>

    <!-- Menú -->
    <nav class="main-menu">
        <div class="menu-links">
            <a href="{{ route('reserva.index') }}" class="{{ request()->is('/') ? 'active' : '' }}">RESERVA</a>
            <a href="{{ route('consulta.index') }}" class="{{ request()->is('consulta') ? 'active' : '' }}">CONSULTA</a>
            <a href="#acerca">ACERCA DE</a>
        </div>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
    

    <!--<main>
        @yield('content')
    </main>-->

    <div class="container">
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
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <strong>Información</strong>
            <a href="#">Contacto</a>
            <a href="#">Acerca de</a>
        </div>
    </footer>

    @include('sweetalert::alert')

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @yield('scripts')
    </body>
</html>

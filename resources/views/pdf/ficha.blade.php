<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ficha de Reserva</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container {
            border: 2px solid #000;
            padding: 20px;
            width: 500px;
            margin: auto;
        }
        img { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('img/LogoSegundo.jpg') }}" width="120" alt="Logo">
        <h2>Ficha de Reserva</h2>
        <p><strong>Número de Ficha:</strong> {{ $numeroFicha }}</p>
        <p><strong>Servicio:</strong> {{ $servicio }}</p>
        <p><strong>Fecha:</strong> {{ $fecha }}</p>
        <p><strong>Nombre:</strong> {{ $nombre }}</p>
        <p><strong>CI:</strong> {{ $ci }}</p>

    </div>
</body>
</html>

@extends('layouts.app')

@section('title', 'Reserva')

@section('content')
<div class="container">
    <div class="form-section">
        <h2>Formulario de Reserva</h2>
        <form action="{{ route('reserva.store') }}" method="POST">
            @csrf
            <!-- Servicio -->
            <div class="form-group">
                <label for="servicio_id">Seleccione Servicio</label>
                <select id="servicio_id" name="servicio_id" required>
                    <option value="">-- Seleccione --</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Requisitos -->
<!--<div class="form-group" id="requisitos-container" style="display:none;">
    <label><strong>Requisitos:</strong></label>
    <div id="lista-requisitos" class="checkbox-group">
        <div class="checkbox-item">
            <span>Rejap Original</span>
            <input type="checkbox" class="req-checkbox">
        </div>
        <div class="checkbox-item">
            <span>Carnet de Identidad vigente</span>
            <input type="checkbox" class="req-checkbox">
        </div>
        <div class="checkbox-item">
            <span>1 Fotocopia de Rejap</span>
            <input type="checkbox" class="req-checkbox">
        </div>
        <div class="checkbox-item">
            <span>2 Fotocopias de C.I.</span>
            <input type="checkbox" class="req-checkbox">
        </div>
        <div class="checkbox-item">
            <span>5 timbres de 10 Bs</span>
            <input type="checkbox" class="req-checkbox">
        </div>
    </div>
</div>-->
<div class="form-group" id="requisitos-container" style="display:none;">
    <label><strong>Requisitos:</strong></label>
    <div id="lista-requisitos" class="checkbox-grid">
        <div class="checkbox-item">
            <input type="checkbox" class="req-checkbox">
            <span>Rejap Original</span>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" class="req-checkbox">
            <span>Carnet de Identidad vigente</span>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" class="req-checkbox">
            <span>1 Fotocopia de Rejap</span>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" class="req-checkbox">
            <span>2 Fotocopias de C.I.</span>
        </div>
        <div class="checkbox-item">
            <input type="checkbox" class="req-checkbox">
            <span>5 timbres de 10 Bs</span>
        </div>
    </div>
</div>
<!-- Nombre -->
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" disabled required>
</div>

<div class="form-group">
    <label for="ci">CI</label>
    <div class="ci-container">
        <input type="number" id="ci" name="ci" placeholder="Ingrese su CI" maxlength="8" disabled required>
        <input type="text" id="ci_ext" name="ci_ext" placeholder="Ext. (Opcional)" style="display:none;">
    </div>
    <small id="ci-error" style="color:red;display:none;">El CI debe tener entre 7 y 8 dígitos.</small>
    <small style="color:#555;">El complemento es opcional (Ej: LP, CBBA).</small>
</div>

            <!-- Fecha -->
            <div class="form-group" id="fecha-container" style="display:none;">
                <label for="fecha">Seleccione Fecha</label>
                <input type="text" id="fecha" name="fecha" placeholder="Seleccione una fecha" required readonly>


            </div>

            <!-- Botón -->
            <div class="btn-container">
                <button type="submit" class="btn-registrar" disabled id="btn-registrar">Registrar</button>
            </div>
        </form>

        <!-- Mensajes -->
        @if(session('numeroFicha'))
            <div class="alert alert-success" style="text-align:center; margin-top:15px;">
                ¡Registro exitoso! Tu número de ficha es:
                <strong>{{ session('numeroFicha') }}</strong>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="text-align:center; margin-top:15px;">
                {{ session('error') }}
            </div>
        @endif
    </div>
     <div class="logo-section">
        <img src="{{ asset('img/LogoSegundo.jpg') }}" alt="Logo Institucional">
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const servicioSelect = document.getElementById('servicio_id');
    const requisitosContainer = document.getElementById('requisitos-container');
    const nombreInput = document.getElementById('nombre');
    const ciInput = document.getElementById('ci');
    const ciExtInput = document.getElementById('ci_ext');
    const fechaContainer = document.getElementById('fecha-container');
    const fechaInput = document.getElementById('fecha');
    const btnRegistrar = document.getElementById('btn-registrar');

    let fechasBloqueadas = [];

    // Inicializa Flatpickr
    const calendario = flatpickr(fechaInput, {
        dateFormat: 'Y-m-d',
        minDate: 'today',
        disable: [],
        onDayCreate: function(dObj, dStr, fp, dayElem) {
            const fechaISO = dayElem.dateObj.toISOString().split('T')[0];
            if (fechasBloqueadas.includes(fechaISO)) {
                dayElem.style.backgroundColor = 'red';
                dayElem.style.color = 'white';
            }
        }
    });

    // Mostrar campo ci_ext solo si hay valor en CI
    ciInput.addEventListener('input', function() {
        if (ciInput.value.trim() !== '') {
            ciExtInput.style.display = 'block';
        } else {
            ciExtInput.style.display = 'none';
            ciExtInput.value = '';
        }
    });

    // Configuración de requisitos
    const requisitosFijos = [
        "Rejap Original",
        "Carnet de Identidad vigente",
        "1 Fotocopia de Rejap",
        "2 Fotocopias de C.I.",
        "5 timbres de 10 Bs"
    ];

    servicioSelect.addEventListener('change', function() {
        const servicioTexto = this.options[this.selectedIndex].text;
        const listaRequisitos = document.getElementById('lista-requisitos');
        listaRequisitos.innerHTML = '';
        fechaContainer.style.display = 'none';
        fechaInput.value = '';
        btnRegistrar.disabled = true;

        if (servicioTexto !== "-- Seleccione --") {
            requisitosContainer.style.display = 'block';

            // Pintar los 5 requisitos fijos
            requisitosFijos.forEach(req => {
                const div = document.createElement('div');
                div.classList.add('checkbox-item');
                div.innerHTML = `<span>${req}</span><input type="checkbox" class="req-checkbox">`;
                listaRequisitos.appendChild(div);
            });

            document.querySelectorAll('.req-checkbox').forEach(chk => {
                chk.addEventListener('change', validarRequisitos);
            });

            // Bloquear fechas llenas desde el backend
            cargarFechasBloqueadas(this.value);
        } else {
            requisitosContainer.style.display = 'none';
        }

        validarRequisitos();
    });

    function validarRequisitos() {
        const checkboxes = document.querySelectorAll('.req-checkbox');
        const todosMarcados = checkboxes.length > 0 && Array.from(checkboxes).every(cb => cb.checked);

        if (todosMarcados) {
            nombreInput.disabled = false;
            ciInput.disabled = false;
            fechaContainer.style.display = 'block';
        } else {
            nombreInput.disabled = true;
            ciInput.disabled = true;
            fechaContainer.style.display = 'none';
            btnRegistrar.disabled = true;
        }
    }

    function cargarFechasBloqueadas(servicioId) {
        fetch(`/servicio/fechas-llenas/${servicioId}`)
            .then(response => response.json())
            .then(fechas => {
                fechasBloqueadas = fechas;
                calendario.set('disable', fechas);
            });
    }

    // Validación CI de 7 a 8 digitos antes de enviar
    btnRegistrar.addEventListener('click', function(e) {
        if (!/^\d{8}$/.test(ciInput.value)) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error en CI',
                text: 'El CI debe tener entre 7 a 8 dígitos.',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    // Habilitar botón cuando se selecciona fecha válida
    fechaInput.addEventListener('change', function() {
        btnRegistrar.disabled = fechaInput.value === '';
    });
});



</script>
@if(session('numeroFicha'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: '¡Reserva Exitosa!',
    html: `
        <p><strong>Número de Ficha:</strong> {{ session('numeroFicha') }}</p>
        <p><strong>Servicio:</strong> {{ session('servicio') }}</p>
        <p><strong>Fecha:</strong> {{ session('fecha') }}</p>
        <p><strong>Nombre:</strong> {{ session('nombre') }}</p>
        <p><strong>CI:</strong> {{ session('ci') }}</p>
    `,
    icon: 'success',
    confirmButtonText: 'Descargar PDF',
    showCancelButton: true,
    cancelButtonText: 'Cerrar'
}).then((result) => {
    if (result.isConfirmed) {
        const url = `/reserva/pdf?servicio=${encodeURIComponent("{{ session('servicio') }}")}&numero=${encodeURIComponent("{{ session('numeroFicha') }}")}&fecha=${encodeURIComponent("{{ session('fecha') }}")}&nombre=${encodeURIComponent("{{ session('nombre') }}")}&ci=${encodeURIComponent("{{ session('ci') }}")}`;
        window.open(url, '_blank');
    }
});
</script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ciInput = document.getElementById('ci');
    const errorText = document.getElementById('ci-error');
    const btnRegistrar = document.getElementById('btn-registrar');
    const maxLength = 8;

    ciInput.addEventListener('input', function() {
        // Eliminar caracteres no numéricos
        ciInput.value = ciInput.value.replace(/\D/g, '');

        // Limitar longitud a 8
        if (ciInput.value.length > maxLength) {
            ciInput.value = ciInput.value.slice(0, maxLength);
        }

        // Validar longitud
      if (ciInput.value.length >= 7 && ciInput.value.length <= 8) {
    errorText.style.display = 'none';
    btnRegistrar.disabled = false;
    } else {
    errorText.style.display = ciInput.value.length > 0 ? 'block' : 'none';
    btnRegistrar.disabled = true;
    }

    });
});
</script>
@endsection



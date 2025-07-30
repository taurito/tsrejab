console.log("JS cargado");

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('consultaForm');
    const ciInput = document.getElementById('ci');
    const resultSection = document.getElementById('result-section');
    const formSection = document.getElementById('form-section');
    const nuevaBusquedaBtn = document.getElementById('nuevaBusquedaBtn');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const ci = ciInput.value.trim();
        const token = document.querySelector('input[name="_token"]').value;

        fetch(`${window.location.origin}/tsrejap/public/consulta`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ ci: ci })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('res-nombre').textContent = data.persona.nombre;
                document.getElementById('res-ci').textContent = data.persona.ci;
                document.getElementById('res-fecha').textContent = data.ficha.fecha;
                document.getElementById('res-entrega').textContent = data.ficha.fecha_entrega ?? 'No definida';

                formSection.style.display = 'none';
                resultSection.style.display = 'block';
            } else {
                alert('No se encontró ninguna reserva con ese CI.');
            }
        })
        .catch(error => {
            console.error('Error en la búsqueda:', error);
            alert('Error al consultar. Verifica la conexión con el servidor.');
        });
    });

    nuevaBusquedaBtn.addEventListener('click', function () {
        form.reset();
        formSection.style.display = 'block';
        resultSection.style.display = 'none';
    });
});

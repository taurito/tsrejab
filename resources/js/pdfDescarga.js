document.addEventListener('DOMContentLoaded', function () {
    if (window.pdfReservaConfig) {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: window.pdfReservaConfig.mensaje,
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = window.pdfReservaConfig.rutaPDF;
        });
    }
});

function cerrarLogoCarga() {
    $(".pantalla-carga").addClass('oculto');
    $(".icono-carga").removeClass('rotar');
}

function activarLogoCarga() {
    $(".pantalla-carga").removeClass('oculto');
    $(".icono-carga").addClass('rotar');
}

$('.boton-prueba').click(function () {
    $('#createPermissionModal').modal('show');
});

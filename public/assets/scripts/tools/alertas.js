
function cerrarAlerta() {
    $("#alerta").addClass('hidden');
    $(".alert").remove();
}

function crearAlerta(mensaje, tipo) {
    // Crear elemento de alerta y asignar clases según el tipo
    var alerta = $('<div>').addClass('alert').text(mensaje);
    // Agregar alerta al contenedor de alertas
    $("#alerta").addClass('alerta-' + tipo)
    $('#contAlerta').append(alerta);
    $("#alerta").removeClass('hidden');
    // Ocultar la alerta después de 3 segundos
    setTimeout(function () {
        alerta.fadeOut('slow', function () {
            $("#alerta").addClass('hidden');
            $(this).remove();
            
        });
    }, 3000);
}




$(document).ready(function () {
    $("#frm_consult_user").submit(function (ev) {
        ev.preventDefault();
        activarLogoCarga();
        $.ajax({
            url: 'resultConsultarUsersAppsView',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                cerrarLogoCarga();
                crearAlerta('Usuario encontrado', 'success');
                $(".area-trabajo").load('listUsersView');

            },
            error: function (xhr) {

                var json = JSON.parse(xhr.responseText);
                crearAlerta(json, 'error');
                cerrarLogoCarga();
                console.log(xhr + 'hola')
            },

        });
    });

    $(".Consultar").on('click', function (e) {
        activarLogoCarga();
        e.preventDefault();
        var IDENTIFICACION = $('#IDENTIFICACION').val();
        var NOMBRE = $('#NOMBRE').val();
        var url = 'resultConsultarUsersAppsView/';
        if (IDENTIFICACION != '') {
            url = url + 0 + '/' + IDENTIFICACION;
             $(".area-trabajo").load(url, function () {
                 cerrarLogoCarga();
             });
        } else if (NOMBRE != '') {
            /*url = url + 1 + '/' + NOMBRE;
             $(".area-trabajo").load(url, function () {
                 cerrarLogoCarga();
             });*/
             crearAlerta('opcion no disponible', 'error');
            cerrarLogoCarga();
        } else {
            crearAlerta('POR FAVOR INGRESAR DATOS PARA PODER REALIZAR LA BUSQUEDA', 'error');
            cerrarLogoCarga();
        }
    });

});
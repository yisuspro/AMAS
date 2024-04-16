$(document).ready(function () {


    $("#frm_create_user").submit(function (ev) {
        ev.preventDefault();
        activarLogoCarga();
        $.ajax({
            url: 'register',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                cerrarLogoCarga();
                crearAlerta('Usuario Creado correctamente','success');
                console.log(xhr)
                //$('#frm_create_user')[0].reset();
                $(".area-trabajo").load('listUsersView');
                
            },
            error: function (xhr) {

                var json = JSON.parse(xhr.responseText);
                crearAlerta(json, 'error');
                cerrarLogoCarga();
                console.log(xhr+'hola')
            },

        });
    });


});
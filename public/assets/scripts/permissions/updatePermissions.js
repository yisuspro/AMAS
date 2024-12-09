$(document).ready(function () {
    // Handle form submission for permission update
    $("#frm_update_permission").on("submit",function (ev) {
        ev.preventDefault();
        activarLogoCarga();
        $.ajax({
            url: '../permissions/updatePermissions',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                cerrarLogoCarga();
                crearAlerta('Permiso actualizado correctamente', 'success');
                $(".area-trabajo").load('../permissions/listPermissionsView');
            },
            error: function (xhr) {
                try {
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                } catch (e) {
                    crearAlerta('Error inesperado en el servidor', 'error');
                }
                cerrarLogoCarga();
            }
        });
    });
    
    // Handle back button click
    $("#back").on('click', function (e) {
        e.preventDefault();
        activarLogoCarga();
        $(".area-trabajo").load('../permissions/listPermissionsView', function () {
            cerrarLogoCarga();
        });
    });
});

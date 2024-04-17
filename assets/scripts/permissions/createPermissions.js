$(document).ready(function () {


     $("#frm_create_permission").submit(function (ev,dt) {
        ev.preventDefault();
        activarLogoCarga();
        $.ajax({
            url: '../permissions/createPermissions',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                cerrarLogoCarga();
                crearAlerta('Permiso creado correctamente', 'success');
                console.log(xhr)
                $('#frm_create_permission')[0].reset();
                $('#createPermissionModal').modal('hide');
                $('#listPermissions').DataTable().ajax.reload();
            },
            error: function (xhr) {
                var json = JSON.parse(xhr.responseText);
                crearAlerta(json, 'error');
                cerrarLogoCarga();
                console.log(xhr + 'hola');
            },

        });
    });



});
$(document).ready(function () {


     $("#frm_create_roles").submit(function (ev,dt) {
        ev.preventDefault();
        activarLogoCarga();
        $.ajax({
            url: '../roles/createRoles',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                cerrarLogoCarga();
                crearAlerta('Rol creado correctamente', 'success');
                console.log(xhr)
                $('#frm_create_roles')[0].reset();
                $('#createRolesModal').modal('hide');
                $('#listRoles').DataTable().ajax.reload();
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
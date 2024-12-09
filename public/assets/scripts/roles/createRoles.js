$(document).ready(function () {
    // Submit event for creating a new role
    $("#frm_create_roles").on("submit",function (ev) {
        ev.preventDefault();
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);  // Disable submit button

        activarLogoCarga();
        $.ajax({
            url: '../roles/createRoles',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                submitBtn.prop('disabled', false); // Re-enable submit button
                cerrarLogoCarga();
                crearAlerta('Rol creado correctamente', 'success');
                $('#frm_create_roles')[0].reset();
                $('#createRolesModal').modal('hide');
                $('#listRoles').DataTable().ajax.reload();
            },
            error: function (xhr) {
                submitBtn.prop('disabled', false); // Re-enable submit button on error
            
                try {
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                } catch (e) {
                    crearAlerta('Error inesperado al crear el rol', 'error');                   
                }
                cerrarLogoCarga();
                console.error('Error response:', xhr.responseText);  // Log error details
                    
            }
        });
    });

});

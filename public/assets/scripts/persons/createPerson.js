$(document).ready(function () {
    // Submit event for creating a new role
    $("#frm_create_person").on("submit", function (ev) {
        ev.preventDefault();
        
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);  // Disable submit button
        
        activarLogoCarga();

        // Create a FormData object to handle the form data including files
        var formData = new FormData(this); // 'this' refers to the form element

        $.ajax({
            url: '../persons/createPerson',
            type: 'POST',
            //data:$(this).serialize(),
            data: formData,
            processData: false, // Prevent jQuery from automatically transforming the data
            contentType: false, // Don't set content type; it's handled by FormData
            success: function (data, xhr) {
                submitBtn.prop('disabled', false); // Re-enable submit button
                cerrarLogoCarga();
                crearAlerta('Persona creado correctamente', 'success');
                $('#frm_create_person')[0].reset();
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

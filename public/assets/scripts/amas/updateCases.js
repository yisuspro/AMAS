$(document).ready(function () {

    $("#frm_create_case").on("submit",function (ev) {
        ev.preventDefault();
        // Show loading spinner
        activarLogoCarga();
        // Perform AJAX request
        $.ajax({
            url: '../audit/createMyCases',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                // Hide loading spinner
                cerrarLogoCarga();
                // Show success message
                crearAlerta('Caso creado correctamente', 'success');
                 // Reset the form and close the modal
                $('#frm_create_case')[0].reset();
                $('#createCaseModal').modal('hide');
                
                // Reload DataTable to reflect the new permission
                $('#listMycases').DataTable().ajax.reload();
            },
            error: function (xhr) {
                // Ensure the response is valid JSON
                let jsonResponse;
                try {
                    jsonResponse = JSON.parse(xhr.responseText);
                } catch (e) {
                    jsonResponse = { message: 'Error inesperado' }; // Fallback message
                }
                // Close loading spinner
                cerrarLogoCarga();
                // Show error message
                crearAlerta(jsonResponse.message || 'Hubo un error al crear el caso', 'error');
                // Optional: log the error details for debugging purposes (remove in production)
                console.error('Error en la creación del caso:', xhr);
            }
        });
    });

  
});

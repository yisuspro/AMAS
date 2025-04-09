$(document).ready(function () {

    $("#frm_update_case").on("submit",function (ev) {
        ev.preventDefault();
        // Show loading spinner
        activarLogoCarga();
        // Perform AJAX request
        $.ajax({
            url: '../audit/updateCase',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
               
                 // Hide loading spinner
                 cerrarLogoCarga();
                 // Show success message
                crearAlerta('Caso creado correctamente', 'success');
                $(".area-trabajo").load('../audit/listMyCaseView');
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

     // Handle back button click
     $("#back").on('click', function (e) {
        e.preventDefault();
        activarLogoCarga();
        $(".area-trabajo").load('../audit/listMyCaseView', function () {
            cerrarLogoCarga();
        });
    });
  
});

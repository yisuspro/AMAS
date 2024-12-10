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
            data: formData,
            processData: false,
            contentType: false,
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


    $('.copy-btn').on("click", function() {
        // Get the input field next to the clicked button
        var textToCopy = $(this).siblings('input')[0];  // Gets the corresponding input element

        // Use the Clipboard API to copy the text
        navigator.clipboard.writeText(textToCopy.value)
            .then(function() {
                crearAlerta('Text copied to clipboard!', 'success');
            })
            .catch(function(err) {
                crearAlerta('Failed to copy text.', 'error');
            });
    });
});

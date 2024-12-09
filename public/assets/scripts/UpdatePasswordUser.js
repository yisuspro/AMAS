(function ($) {
    $("#frm_update_password_user").on("submit",function (ev) {
        ev.preventDefault();
        
        $.ajax({
            url: '../UpdatePasswordUser',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, textStatus, xhr) {
                // Redirection should happen first
                //var rute = 'users/profileUser';
                //window.location.href = rute;

                try {
                    var json = JSON.parse(xhr.responseText); // Parse the response if needed
                    console.log(json);
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('An error occurred while processing the response.');
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status == 401) {
                    // Add invalid classes to fields
                    $("#USER_password_A").addClass('is-invalid');
                    $("#USER_password_P").addClass('is-invalid');
                    $("#USER_password_two_P").addClass('is-invalid');
                    
                    try {
                        var json = JSON.parse(xhr.responseText);
                        console.log(json);
                        crearAlerta(json, 'error'); // Show an alert with the error details
                    } catch (e) {
                        console.error('Error parsing error response:', e);
                        alert('An error occurred while processing the error response.');
                    }
                } else if (xhr.status == 402) {
                    // Placeholder for other error handling
                    alert('Payment or other issues detected.');
                } else {
                    // Generic error handling for unexpected status codes
                    alert('An unexpected error occurred. Please try again later.');
                }
            }
        });
    });

    // Close alert button handler
    $('.btn_close').on("click",function() {
        cerrarAlerta(); // Calls the function defined elsewhere to close alerts
    });
})(jQuery);

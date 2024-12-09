(function ($) {
    $("#frm_login").on("submit",function (ev) {
        ev.preventDefault();
        
        $.ajax({
            url: 'users/login',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                try {
                    var data = JSON.parse(response);
                    console.log(data.USER_reset_password);
                    console.log(data.USER_PK);
                    
                    // Redirection logic based on password reset flag
                    if (data.USER_reset_password == 1) {
                        var rute = 'users/UpdatePasswordUserView/' + data.USER_PK;
                        window.location.href = rute;
                        console.log('Redirection to password change');
                    } else {
                        var rute = 'users/profileUser';
                        window.location.href = rute;
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    alert('An error occurred while processing the response.');
                }
            },
            error: function (xhr) {
                // Handle different status codes
                if (xhr.status == 401) {
                    $("#USER_username").addClass('is-invalid');
                    $("#USER_password").addClass('is-invalid');
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                } else if (xhr.status == 402) {
                    // Handle the specific case for status code 402 if needed
                } else {
                    // Handle other potential status codes (e.g., server errors)
                    alert('An unexpected error occurred. Please try again later.');
                }
            },
        });
    });

    // Close alert on button click
    $('.btn_close').on("click",function () {
        cerrarAlerta(); // Llama a la función definida en script.js
    });

})(jQuery);

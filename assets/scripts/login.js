(function ($) {
    $("#frm_login").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'users/login',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                var rute = 'users/profileUser';
                window.location.href = rute;
            },
            error: function (xhr) {
                if (xhr.status == 401) {
                    $("#USER_username").addClass('is-invalid');
                    $("#USER_password").addClass('is-invalid');
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json,'error');
                    //alert('error = ' + json);
                } else if (xhr.status == 402) {

                }
            },

        });
    });
    $('.btn_close').click(function() {
        cerrarAlerta(); // Llama a la función definida en script.js
    });
    
})(jQuery)
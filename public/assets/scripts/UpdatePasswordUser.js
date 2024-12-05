(function ($) {
    $("#frm_update_password_user").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: '../UpdatePasswordUser',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr,response) {
                var rute = '../profileUser';
                window.location.href = rute;
                var json = JSON.parse(response.responseText);
                console. log(json);
              
            },
            error: function (xhr,response) {
                if (xhr.status == 401) {
                    $("#USER_password_A").addClass('is-invalid');
                    $("#USER_password_P").addClass('is-invalid');
                    $("#USER_password_two_P").addClass('is-invalid');
                    var json = JSON.parse(response.responseText);
                    console. log(json);
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
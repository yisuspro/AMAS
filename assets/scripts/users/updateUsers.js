$(document).ready(function () {


    $("#frm_update_user").submit(function (ev) {
       ev.preventDefault();
       activarLogoCarga();
       $.ajax({
           url: '../users/updateUsers',
           type: 'POST',
           data: $(this).serialize(),
           success: function (data, xhr) {
               cerrarLogoCarga();
               crearAlerta('Usuario Actualizado correctamente','success');
               console.log(xhr)
               $(".area-trabajo").load('../users/listUsersView');
           },
           error: function (xhr) {
               var json = JSON.parse(xhr.responseText);
               crearAlerta(json, 'error');
               cerrarLogoCarga();
               console.log(xhr + 'hola');
           },

       });
   });

   $("#frm_update_password_users").submit(function (ev) {
    ev.preventDefault();
    activarLogoCarga();
    $.ajax({
        url: '../users/updatePasswordUsers',
        type: 'POST',
        data: $(this).serialize(),
        success: function (data, xhr,response) {
            cerrarLogoCarga();
            crearAlerta('Usuario Actualizado correctamente','success');
            $('#updatePasswordUsers').modal('hide');
            $('#frm_update_password_users')[0].reset();
        },
        error: function (xhr) {
            var json = JSON.parse(xhr.responseText);
            crearAlerta(json, 'error');
            cerrarLogoCarga();
        },

    });
});
});
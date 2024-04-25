$(document).ready(function () {


    $("#frm_update_role").submit(function (ev) {
       ev.preventDefault();
       activarLogoCarga();
       $.ajax({
           url: '../roles/updateRoles',
           type: 'POST',
           data: $(this).serialize(),
           success: function (data, xhr) {
               cerrarLogoCarga();
               crearAlerta('Rol Actualizado correctamente','success');
               console.log(xhr)
               $(".area-trabajo").load('../roles/listRolesView');
           },
           error: function (xhr) {
               var json = JSON.parse(xhr.responseText);
               crearAlerta(json, 'error');
               cerrarLogoCarga();
               console.log(xhr + 'hola');
           },

       });
   });
});
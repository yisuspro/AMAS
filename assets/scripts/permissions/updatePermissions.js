$(document).ready(function () {


    $("#frm_update_permission").submit(function (ev) {
       ev.preventDefault();
       activarLogoCarga();
       $.ajax({
           url: '../permissions/updatePermissions',
           type: 'POST',
           data: $(this).serialize(),
           success: function (data, xhr) {
               cerrarLogoCarga();
               crearAlerta('Permiso Actualizado correctamente','success');
               console.log(xhr)
               $(".area-trabajo").load('../permissions/listPermissionsView');
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
$(document).ready(function () {
    var dt;
    var ROL;
    USER_PK = $('#idUser').val();
    console.log(ROL);
    dt = $('#listUsersRoles');
    dt.DataTable({
        dom: null,
        order: [
            [3, 'des']
        ],
        scrollX: true,
        ajax: {
            url: "../users/listUsersRoles/"+ USER_PK,
            type: 'GET'
        },
        columns: [
            { data: 'ROLE_PK' },
            { data: 'ROLE_name' },
            { data: 'ROLE_description' },
            { data: 'USRL_state', },
        ],
        buttons: [
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i>',
                className: 'btn btn-secondary',
                titleAttr: 'Copiar datos'
            },
            {
                extend: 'copy',
                text: '<i class="bi bi-clipboard"></i>',
                className: 'btn btn-secondary',
                titleAttr: 'Copiar datos'
            },
            {
                extend: 'excel',
                text: '<i class="bi bi-file-earmark-spreadsheet"></i>',
                className: 'btn btn-secondary',
                titleAttr: 'Exportar datos a Excel'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-filetype-pdf"></i> ',
                className: 'btn btn-secondary',
                titleAttr: 'Exportar datos a PDF'
            },
            {
                extend: 'csv',
                text: '<i class="bi bi-filetype-csv"></i> ',
                className: 'btn btn-secondary',
                titleAttr: 'Exportar datos a PDF'
            },
            {
                text: '<i class="bi bi-arrow-clockwise"></i>',
                className: 'btn btn-secondary',
                titleAttr: 'Recargar tabla',
                action: function (e, dt, node, config) {
                    activarLogoCarga();
                    dt.ajax.reload();
                    cerrarLogoCarga();
                },
            }
        ],
        layout: {
            top: 'buttons',
            topStart: 'pageLength',
            topEnd: {
                search: {
                    placeholder: 'buscar'
                }
            },
            bottomStart: 'info',
            bottomEnd: 'paging'
        },
        rowCallback: function (row, data) {
            if (data['USRL_state'] == 1) {
                $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
            }  else {
                $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
            }

        },
        columnDefs: [
            {
              "targets": [4],
              "visible": false,
              "searchable": false,
              "data": "USRL_FK_user",
              "name": "USRL_FK_user"
            }
          ]


    });

    dt.on('click', '.estado_sw', function (e) {
        activarLogoCarga();
        e.preventDefault();
        b = document.querySelector("button");
        USER_PK = $('#idUser').val();
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r ; 
        if(O.RLPR_state == '1'){
            r= confirm('Seguro deseas quitar el rol = "' + O.ROLE_name + '" al usuario = ' + USER_PK);

        }else{
            r= confirm('Seguro deseas asignar el rol = "' + O.ROLE_name + '" al usuario = ' + USER_PK);
        }
        if (r == true) {
            $.ajax({
                url: '../users/addRolesUsers/' + O.ROLE_PK + '/'+ USER_PK,
                type: 'POST',
                data: $tr,
                success: function(data, xhr) {
                    crearAlerta('cambio de estado exitoso', 'success');
                    $('#listRolesPermissions').DataTable().ajax.reload();
                    cerrarLogoCarga();
                },
                error: function(xhr) {
                    var json = JSON.parse(xhr.responseText);
                    cerrarLogoCarga();
                    crearAlerta('fallo cambio'+json, 'error');
                    

                },

            });
            if($(this).find(' #toggleCheckbox').is(':checked')){
                $(this).find(' #toggleCheckbox').removeAttr('checked');
                console.log('Se quitó el atributo "disabled".');
                
            }else{
                $(this).find(' #toggleCheckbox').attr( "checked","");
                console.log('Se agrego el atributo "disabled".');
            }
            
            
        } else {
            cerrarLogoCarga();
            crearAlerta('se recahza ale cambio cambio', 'error');
        }


    });


});
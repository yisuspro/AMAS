$(document).ready(function () {
    var dt;
    dt = $('#listRoles');
    dt.DataTable({
        dom: null,
        order: [
            [0, 'des']
        ],
        scrollX: true,
        ajax: {
            url: "../roles/listRoles",
            type: 'GET'
        },
        columns: [
            { data: 'ROLE_PK' },
            { data: 'ROLE_name' },
            { data: 'ROLE_description' },
            { data: 'ROLE_state', },
            { data: 'ROLE_date_create', },
            { data: 'ROLE_date_update', },
            { "defaultContent": "<a id='Act_roles' name='Act_roles' title='Actualizar Rol' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a><a id='Add_permission' name='Add_permission' title='Agregar Permiso' type='button' class='form btn btn-success btn-xs'><i class='bi bi-node-plus'></i></a>" },

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
            },
            {
                text: '<i class="bi bi-plus-lg">CREAR ROL</i>',
                className: 'btn btn-success',
                titleAttr: 'Agregar rol',
                action: function (e, dt, node, config) {
                    activarLogoCarga();
                    $('#createRolesModal').modal('show');
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
            if (data['ROLE_state'] == 1) {
                $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
            } else if (data['ROLE_state'] == 0) {
                $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
            } else {
                $($(row).find("td")[3]).html("<p class='text-danger'> SIN ESTADO</p>");
            }

        },


    });

    dt.on('click', '#Act_roles', function (e) {

        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r = confirm("Seguro deseas editar la informacion del rol" + O.ROLE_name);
        if (r == true) {
            activarLogoCarga();
            var id = '../roles/updateRolesView/' + O.ROLE_PK;
            $(".area-trabajo").load(id);
            cerrarLogoCarga();
            crearAlerta('Vista modificacion rol abierta correctamente', 'success');
        } else {
            crearAlerta('Cambio rechazado', 'error');
        }

    });

    dt.on('click', '.estado_sw', function (e) {
        activarLogoCarga();
        e.preventDefault();
        b = document.querySelector("button");
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r ; 
        if(O.RLPR_state == '1'){
            r= confirm('Seguro deseas inactivar el rol = "' + O.ROLE_name + '"');

        }else{
            r= confirm('Seguro deseas activar el rol = "' + O.ROLE_name + '"');
        }
        if (r == true) {
            $.ajax({
                url: '../roles/updateStateRoles/' + O.ROLE_PK,
                type: 'POST',
                data: $tr,
                success: function(data, xhr) {
                    cerrarLogoCarga();
                    crearAlerta('cambio de estado exitoso', 'success');
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

    dt.on('click', '#Add_permission', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r = confirm("Seguro deseas asignar permisos al rol " + O.ROLE_name);
        if (r == true) {
            activarLogoCarga();
            var id = '../roles/addPermissionsRolesViews/' + O.ROLE_PK;
            $(".area-trabajo").load(id);
            cerrarLogoCarga();
            crearAlerta('Vista asignacion permisos abierta correctamente', 'success');
        } else {
            crearAlerta('Asignacion rechazada', 'error');
        }

    });


});
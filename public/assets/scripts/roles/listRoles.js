$(document).ready(function () {
    var userPermissions;

    $.ajax({
        url: "../users/getPermissionsUsers",
        type: 'GET',
        success: function (data) {
            userPermissions = data;
            initializeDataTable(userPermissions);
        }
    });

    function initializeDataTable(userPermissions) {
        var dt;
        dt = $('#listRoles');
        dt.DataTable({
            dom: null,
            order: [
                [3, 'des']
            ],
            scrollX: true,
            ajax: {
                url: "../roles/listRoles",
                type: 'GET'
            },
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { title:'ID ROL',data: 'ROLE_PK' },
                { title:'NOMBRE',data: 'ROLE_name' },
                { title:'DESCRIPCIÓN',data: 'ROLE_description' },
                { title:'ESTADO',data: 'ROLE_state', },
                { title:'F. CREACIÓN',data: 'ROLE_date_create', },
                { title:'F. MODIFICACIÓN',data: 'ROLE_date_update', },
                {   
                    title: 'ACCIONES',
                    data: null,
                    render: function (data, type, row) {
                        var buttons = '';

                        if (userPermissions.includes('E_ROLES')) {
                            buttons += "<a id='Act_roles' name='Act_roles' title='Actualizar Rol' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a>";
                        }
                        if (userPermissions.includes('A_ROLES')) {
                            buttons += "<a id='Add_permission' name='Add_permission' title='Agregar Permiso' type='button' class='form btn btn-success btn-xs'><i class='bi bi-node-plus'></i></a>";
                        }

                        return buttons;
                    }
                },

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
                        dt.ajax.reload();
                    },
                },
                ...(userPermissions.includes('CR_ROLES') ? [{
                    text: '<i class="bi bi-plus-lg">CREAR ROL</i>',
                    className: 'btn btn-success',
                    titleAttr: 'Agregar rol',
                    action: function (e, dt, node, config) {
                        activarLogoCarga();
                        $('#createRolesModal').modal('show');
                        cerrarLogoCarga();
                    },
                }] : [])
            ],
            layout: {
                top2Start: '',
                top2End: '',
                topStart: '',
                topEnd: '',
                bottomStart: 'pageLength',
                bottomEnd: {
                    search: {
                        placeholder: 'Buscar'
                    }
                },
                bottom2Start: 'info',
                bottom2End: 'paging',
                bottom3End: 'buttons'
            },
            rowCallback: function (row, data) {
                if (userPermissions.includes('I_ROLES')) {
                    if (data['ROLE_state'] == 1) {
                        $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
                    } else if (data['ROLE_state'] == 0) {
                        $($(row).find("td")[3]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
                    } else {
                        $($(row).find("td")[3]).html("<p class='text-danger'> SIN ESTADO</p>");
                    }
                } else {
                    if (data['ROLE_state'] == 1) {
                        $($(row).find("td")[3]).html("<p class='text-success'>ACTIVO</p>");
                    } else if (data['ROLE_state'] == 0) {
                        $($(row).find("td")[3]).html("<p class='text-danger'>INACTIVO</p>");
                    } else {
                        $($(row).find("td")[3]).html("<p class='text-warning'>SIN ESTADO</p>");
                    }
                }


            },


        });

        dt.on('click', 'td.dt-control', function (e) {
            let tr = e.target.closest('tr');
            let row = dt.DataTable().row(tr);
         
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            }
            else {
                // Open this row
                row.child(JSON.stringify(row.data())
                        .replace(/{/g, '[')
                        .replace(/}/g, ']')
                        .replace(/:/g, '=>')).show();
            }
        });

        dt.on('click', '#Act_roles', function (e) {

            e.preventDefault();
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            var r = confirm("Seguro deseas editar la informacion del rol" + O.ROLE_name);
            if (r == true) {
                activarLogoCarga();
                var id = '../roles/updateRolesView/' + O.ROLE_PK;
                $(".area-trabajo").load(id, function () {
                    cerrarLogoCarga();
                });
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
            var r;
            if (O.RLPR_state == '1') {
                r = confirm('Seguro deseas inactivar el rol = "' + O.ROLE_name + '"');

            } else {
                r = confirm('Seguro deseas activar el rol = "' + O.ROLE_name + '"');
            }
            if (r == true) {
                $.ajax({
                    url: '../roles/updateStateRoles/' + O.ROLE_PK,
                    type: 'POST',
                    data: $tr,
                    success: function (data, xhr) {
                        cerrarLogoCarga();
                        crearAlerta('cambio de estado exitoso', 'success');
                    },
                    error: function (xhr) {
                        var json = JSON.parse(xhr.responseText);
                        cerrarLogoCarga();
                        crearAlerta('Fallo cambio' + json, 'error');


                    },

                });
                if ($(this).find(' #toggleCheckbox').is(':checked')) {
                    $(this).find(' #toggleCheckbox').removeAttr('checked');
                    console.log('Se quitó el atributo "disabled".');

                } else {
                    $(this).find(' #toggleCheckbox').attr("checked", "");
                    console.log('Se agrego el atributo "disabled".');
                }


            } else {
                cerrarLogoCarga();
                crearAlerta('se rechaza ale cambio cambio', 'error');
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
                $(".area-trabajo").load(id, function () {
                    cerrarLogoCarga();
                });
                crearAlerta('Vista asignacion permisos abierta correctamente', 'success');
            } else {
                crearAlerta('Asignacion rechazada', 'error');
            }

        });


    }
});
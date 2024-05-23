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
        dt = $('#sample_1');
        dt.DataTable({
            dom: null,
            order: [
                [8, 'asc']
            ],
            scrollX: true,
            ajax: {
                url: "listUser",
                type: 'GET'
            },
            order: [8, 'asc'],
            columns: [
                { data: 'USER_PK' },
                { data: 'USER_name' },
                { data: 'USER_identification' },
                { data: 'USER_username'},
                { data: 'USER_email'},
                { data: 'USER_address_ip'},
                { data: 'USER_date_create', },
                { data: 'USER_date_update', },
                { data: 'STTS_name', },
                {
                    data: null,
                    render: function (data, type, row) {
                        var buttons = '';

                        if (userPermissions.includes('E_USERS')) {
                            buttons += "<a id='Act_usuario' name='Act_usuario' title='Actualizar usuario' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a>";
                        }
                        if (userPermissions.includes('A_ROLES')) {
                            buttons += "<a id='asig_rol' name='asig_rol' title='Asignar Rol' type='button' class='form btn btn-success btn-xs' history'><i class='bi bi-node-plus'></i></a>";
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
                if (userPermissions.includes('I_USERS')) {
                    if (data['USER_FK_state_user'] == 1) {
                        $($(row).find("td")[8]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
                    } else if (data['USER_FK_state_user'] == 0) {
                        $($(row).find("td")[8]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
                    } else {
                        $($(row).find("td")[8]).html("<p class='text-danger'> SIN ESTADO</p>");
                    }
                } else {
                    if (data['USER_FK_state_user'] == 1) {
                        $($(row).find("td")[8]).html("<p class='text-success'>ACTIVO</p>");
                    } else if (data['USER_FK_state_user'] == 0) {
                        $($(row).find("td")[8]).html("<p class='text-danger'>INACTIVO</p>");
                    } else {
                        $($(row).find("td")[8]).html("<p class='text-warning'>SIN ESTADO</p>");
                    }

                }
                if(data['USER_address_ip'] == null || data['USER_address_ip'] == ''  || data['USER_address_ip'] == 0){
                    $($(row).find("td")[5]).html("<p class='text-danger'>SIN RESTRICCION</p>");
                }else{
                    $($(row).find("td")[5]).html("<p class='text-success'>["+data['USER_address_ip']+"]</p>");
                }


            },


        });


        dt.on('click', '#Act_usuario', function (e) {

            e.preventDefault();
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            var r = confirm("Seguro deseas editar la informacion del usuario " + O.USER_name);
            if (r == true) {
                activarLogoCarga();
                var url = '../users/updatetUserView/' + O.USER_PK;
                $(".area-trabajo").load(url);
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
            var r;
            if (O.USER_FK_state_user == '1') {
                r = confirm('Seguro deseas inactivar el rol = "' + O.USER_name + '"');

            } else {
                r = confirm('Seguro deseas activar el rol = "' + O.USER_name + '"');
            }
            if (r == true) {
                $.ajax({
                    url: '../users/updateStateUsers/' + O.USER_PK,
                    type: 'POST',
                    data: $tr,
                    success: function (data, xhr) {
                        cerrarLogoCarga();
                        crearAlerta('cambio de estado exitoso', 'success');
                    },
                    error: function (xhr) {
                        var json = JSON.parse(xhr.responseText);
                        cerrarLogoCarga();
                        crearAlerta('fallo cambio' + json, 'error');
                    },

                });
                if ($(this).find(' #toggleCheckbox').is(':checked')) {
                    $(this).find(' #toggleCheckbox').removeAttr('checked');

                } else {
                    $(this).find(' #toggleCheckbox').attr("checked", "");
                }


            } else {
                cerrarLogoCarga();
                crearAlerta('se recahza ale cambio cambio', 'error');
            }


        });

        dt.on('click', '#asig_rol', function (e) {
            activarLogoCarga();
            e.preventDefault();
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            var url = '../users/addRolesUsersView/' + O.USER_PK;
            $(".area-trabajo").load(url, function () {
                cerrarLogoCarga();
            });
            crearAlerta('Vista modificacion rol abierta correctamente', 'success');

        });

    }


});
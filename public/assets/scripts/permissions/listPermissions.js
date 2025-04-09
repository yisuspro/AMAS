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
        dt = $('#listPermissions');
        dt.DataTable({
            dom: null,
            order: [
                [0, 'des']
            ],
            scrollX: true,
            ajax: {
                url: "../permissions/listPermissions",
                type: 'GET'
            },
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { title:'ID',data: 'PRMS_PK' },
                { title:'NOMBRE',data: 'PRMS_name' },
                { title:'DESCRIPCIÓN',data: 'PRMS_description' },
                { title:'NOMBRE CORTO',data: 'PRMS_system_name', },
                { title:'ESTADO',data: 'PRMS_state', },
                { title:'F.CREACIÓN',data: 'PRMS_date_create', },
                { title:'F. MODIFICACIÓN',data: 'PRMS_date_update', },
                {
                    title:'ACCIONES',
                    data: null,
                    render: function (data, type, row) {
                        var buttons = '';

                        if (userPermissions.includes('E_PERMI')) {
                            buttons += "<a id='Act_permissions' name='Act_permissions' title='Actualizar Permiso' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a>";
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
                },
                ...(userPermissions.includes('CR_PERMI') ? [{
                    text: '<i class="bi bi-plus-lg">CREAR PERMISO</i>',
                    className: 'btn btn-success',
                    titleAttr: 'Agregar Permiso',
                    action: function (e, dt, node, config) {
                        $('#createPermissionModal').modal('show');
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
                if (userPermissions.includes('I_PERMI')) {
                    if (data['PRMS_state'] == 1) {
                        $($(row).find("td")[4]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
                    } else if (data['PRMS_state'] == 0) {
                        $($(row).find("td")[4]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
                    } else {
                        $($(row).find("td")[4]).html("<p class='text-danger'> SIN ESTADO</p>");
                    }
                } else {
                    if (data['PRMS_state'] == 1) {
                        $($(row).find("td")[4]).html("<p class='text-success'>ACTIVO</p>");
                    } else if (data['PRMS_state'] == 0) {
                        $($(row).find("td")[4]).html("<p class='text-danger'>INACTIVO</p>");
                    } else {
                        $($(row).find("td")[4]).html("<p class='text-warning'>SIN ESTADO</p>");
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

        dt.on('click', '#Act_permissions', function (e) {

            e.preventDefault();
            $tr = $(this).closest('tr');
            var O = dt.DataTable().row($tr).data();
            var r = confirm("Seguro deseas editar la informacion del permiso" + O.PRMS_system_name);
            if (r == true) {
                activarLogoCarga();
                var id = '../permissions/updatePermissionsView/' + O.PRMS_PK;
                $(".area-trabajo").load(id, function () {
                    cerrarLogoCarga();
                });
                crearAlerta('Vista modificacion permisos abierta correctamente', 'success');
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
                r = confirm('Seguro deseas inactivar el permiso = "' + O.PRMS_system_name + '"');

            } else {
                r = confirm('Seguro deseas activar el permiso = "' + O.PRMS_system_name + '"');
            }
            if (r == true) {
                $.ajax({
                    url: '../permissions/updateStatePermissions/' + O.PRMS_PK,
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
                crearAlerta('Se rechaza el cambio', 'error');
            }


        });

    }
});
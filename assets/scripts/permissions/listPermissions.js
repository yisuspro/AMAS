$(document).ready(function () {
    var dt;
    dt = $('#listPermissions');
    dt.DataTable({
        dom: null,
        order: [
            [0, 'des']
        ],
        scrollx: true,
        ajax: {
            url: "../permissions/listPermissions",
            type: 'GET'
        },
        columns: [
            { data: 'PRMS_PK' },
            { data: 'PRMS_name' },
            { data: 'PRMS_description' },
            { data: 'PRMS_system_name', },
            { data: 'PRMS_state', },
            { data: 'PRMS_date_create', },  
            { data: 'PRMS_date_update', },
            { "defaultContent": "<a id='Act_permissions' name='Act_permissions' title='Actualizar Permiso' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a>" },

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
                text: '<i class="bi bi-plus-lg">CREAR</i>',
                className: 'btn btn-success',
                titleAttr: 'Agregar Permiso',
                action: function (e, dt, node, config) {
                    activarLogoCarga();
                    $('#createPermissionModal').modal('show');
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
            if (data['PRMS_state'] == 1) {
                $($(row).find("td")[4]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox" checked><span class="slider round"></span></label>');
            } else if (data['PRMS_state'] == 0) {
                $($(row).find("td")[4]).html('<label class="switch estado_sw" id="toggleSwitch"><input type="checkbox" id="toggleCheckbox"><span class="slider round"></span></label>');
            } else {
                $($(row).find("td")[4]).html("<p class='text-danger'> SIN ESTADO</p>");
            }

        },


    });

    dt.on('click', '#Act_permissions', function (e) {

        e.preventDefault();
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r = confirm("Seguro deseas editar la informacion del permiso" + O.PRMS_system_name);
        if (r == true) {
            activarLogoCarga();
            var id = '../permissions/updatePermissionsView/' + O.PRMS_PK;
            $(".area-trabajo").load(id);
            cerrarLogoCarga();
            crearAlerta('Vista modificacion permisos abierta correctamente', 'success');
        } else {
            crearAlerta('Cambio rechazado', 'error');
        }

    });

    dt.on('click', '.estado_sw', function (e) {
        //activarLogoCarga();
        e.preventDefault();
        b = document.querySelector("button");
        $tr = $(this).closest('tr');
        var O = dt.DataTable().row($tr).data();
        var r = confirm("Seguro deseas cambiar el estado del permiso " + O.PRMS_system_name);
        if (r == true) {
            $.ajax({
                url: '../permissions/updateStatePermissions/' + O.PRMS_PK,
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


});
$(document).ready(function () {
    var dt;
    dt = $('#sample_1');
    dt.DataTable({
        dom: null,
        order:[
            [1,'asc']
        ],
        scrollx:true,
        ajax: {
            url: "listUser",
            type: 'GET'
        },
        columns: [
            { data: 'USER_PK' },
            { data: 'USER_name' },
            { data: 'USER_identification' },
            { data: 'USER_username', },
            { data: 'USER_date_create', },
            { data: 'USER_date_update', },
            { data: 'STTS_name', },
            { "defaultContent": "<a id='asig_rol' name='asig_rol' title='Asignar Rol' type='button' class='form btn btn-primary btn-xs history'><i class='bi bi-plus-lg'></i></a><a id='Act_usuario' name='Act_usuario' title='Actualizar usuario' type='button' class='form btn btn-success btn-xs'><i class='bi bi-arrow-up'></i></a><a id='elim_usu' name='elim_usu' title='Eliminar usuario' type='button' class='form btn btn-danger btn-xs'><i class='bi bi-dash'></i></a>" },

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
            if (data['STTS_name'] == "ACTIVO") {
                $($(row).find("td")[6]).html("<p class='text-success'>"+data['STTS_name']+"</p>");
            } else if (data['STTS_name'] == "INACTIVO") {
                $($(row).find("td")[6]).html("<p class='text-danger'>"+data['STTS_name']+"</p>");
            } else if (data['STTS_name'] == "suspendido") {
                $($(row).find("td")[6]).html("<p class='text-warning'>"+data['STTS_name']+"</p>");
            }

        },


    });



});
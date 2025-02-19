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
        function format(d) {
            // `d` is the original data object for the row
            return (
                '<dl>' +
                '<dt>ENTIDAD</dt>' +
                '<dd>' +
                d.ENTS_name +
                '</dd>' +
                '<dt>DEPENDENCIA</dt>' +
                '<dd>' +
                d.DPND_name +
                '</dd>'  + '</dl>' +
                '<dl>' +
                '<dt>ACCIONES</dt>' +
                '<dd>' +
                d.actions +
                '</dd>' +
                '<dt>OBSERVACIONE</dt>' +
                '<dd>' +
                d.observations +
                '</dd>'  + '</dl>'

            );
        }
        var dt;
        dt = $('#listMycases');
        dt.DataTable({
            dom: null,
            order: [
                [0, 'des']
            ],
            scrollX: true,
            ajax: {
                url: "../audit/listMyCase",
                type: 'GET'
            },
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { title:'ID',data: 'CASE_PK' , visible: false},
                { title:'CASO',data: 'CASE_number', },
                { title:'ESTADO',data: 'STCS_name', },
                { title:'TIPO',data: 'TPCS_name', },
                { title:'GRUPO',data: 'GRPS_name', },
                { title:'APP',data: 'APPS_name', },
                { title:'NIVEL',data: 'CTCS_name', },
                { title:'RESPONSABLE',data: 'USER_name', visible: false },
                { title:'F.SOLUCIÓN',data: 'CASE_date_solution', },
                {
                    title:'ACCIONES',
                    data: null,
                    render: function (data, type, row) {
                        var buttons = '';

                        if (userPermissions.includes('E_AUDIT_CASE')) {
                            buttons += "<a id='Act_case' name='Act_case' title='Editar Caso' type='button' class='form btn btn-warning btn-xs'><i class='bi bi-pencil-square'></i></a>";
                        }
                        if (userPermissions.includes('I_AUDIT_CASE')) {
                            buttons += "<a id='Ina_case' name='Ina_case' title='Inactivar Caso' type='button' class='form btn btn-danger btn-xs'><i class='bi bi-trash3'></i></a>";
                        }
                        if (userPermissions.includes('C_AUDIT_CASE')) {
                            buttons += "<a id='Cons_case' name='Cons_case' title='Consultar caso' type='button' class='form btn btn-primary btn-xs'><i class='bi bi-eye'></i></a>";
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
                ...(userPermissions.includes('CR_CASO') ? [{
                    text: '<i class="bi bi-plus-lg">REGISTRAR CASO</i>',
                    className: 'btn btn-success',
                    titleAttr: 'Registrar caso',
                    action: function (e, dt, node, config) {
                        $('#createCaseModal').modal('show');
                    },
                }] : [])

            ],
            layout: {
                top2Start: 'buttons',
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
                bottom3End: ''
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
                row.child(format(row.data())).show();
            }
        });


    }
});
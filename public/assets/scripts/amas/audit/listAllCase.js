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
                '<dt>OBSERVACIONES</dt>' +
                '<dd>' +
                d.observations +
                '</dd>'  + '</dl>'

            );
        }
        var dt;
        dt = $('#listAllcases');
        
        dt.DataTable({
            ordering: false, // Desactiva la función de ordenar en toda la tabla
            dom: null,
            order: [
                [2, 'desc']
            ],
            scrollX: true,
            ajax: {
                url: "../audit/listAllCase",
                type: 'GET'
            },
            columnDefs: [
                { width: '10px', targets: 0 },  // Columna de control (expansión)
                { width: '10px', targets: 1 },  // ID (oculto)
                { width: '20px', targets: 2 }, // Caso
                { width: '100px', targets: 3 }, // Estado
                { width: '100px', targets: 4 }, // Tipo
                { width: '100px', targets: 5 }, // Grupo
                { width: '30px', targets: 6 }, // APP
                { width: '30px', targets: 7 },  // Nivel
                { width: '200px', targets: 8 }, // Responsable
                { width: '100px', targets: 9 }, // Fecha solución
                { width: '100px', targets: 10 } // Acciones (botones)
            ],
            fixedColumns: true ,
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { title:'ID',data: 'CASE_PK' , visible: false},
                { title:'CASO',data: 'CASE_number', },
                { title:'ESTADO',data: 'STCS_name',
                    render: function (data) {
                    if (data =='SOLUCIONADO') {
                         color = 'green';
                     }
                     else if(data =='RECHAZADO'){
                         color = 'red';
                     }
     
                     return `<span style="color:${color}">${data}</span>`;
                 } },
                { title:'TIPO',data: 'TPCS_name', },
                { title:'GRUPO',data: 'GRPS_name', },
                { title:'APP',data: 'APPS_name', },
                { title:'NIVEL',data: 'CTCS_name', },
                { title:'RESPONSABLE',data: 'USER_name' },
                { title:'F.RECEPCIÓN',data: 'CASE_date_reception' },
                { title:'F.SOLUCIÓN',data: 'CASE_date_solution' },
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
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        let column = this;
                        let title = column.header().textContent;
         
                        // Create input element
                        let input = document.createElement('input');
                        input.placeholder = title;
                        column.header().replaceChildren(input);
                        input.style.width = "100%";
                        input.style.fontSize = "12px";
         
                        // Event listener for user input
                        input.addEventListener('keyup', () => {
                            if (column.search() !== this.value) {
                                column.search(input.value).draw();
                            }
                        });
                    });
                    this.api().columns.adjust();

            }
            
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
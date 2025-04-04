$(document).ready(function () {
    function format(d) {
        // `d` is the original data object for the row
            return ('<div class="row">'+
                '<div class="col form-label">PERMISOS</div>'+
                '<div class="col">'+d.ROLES+'</div>'+
                '<div class="col">'+
                    '<div class="mb-3">'+
                        '<label for="DCPR_name_1" class="form-label">Fecha de vigencia</label>'+
                        '<input type="text" value="'+d.FECHA_INACTIVACION+'" class="form-control" readonly>'+
                    '</div>'+
                    '<div class="mb-3">'+
                        '<label for="DCPR_name_1" class="form-label">Fecha último acceso</label>'+
                        '<input type="text" value="'+d.FECHALOGEADO+'" class="form-control" readonly>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col form-label">CARGO</div>'+
                    '<div class="col">'+
                    d.CARGO +
                    '</div>'+
                    '<div class="col"></div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col form-label">RAZÓN DE INACTIVACIÓN</div>'+
                    '<div class="col">'+
                    d.NOMBRE_INACTIVO +
                    '</div>'+
                    '<div class="col"></div>'+
                '</div>')
    }

    $("#frm_consult_users").submit(function (ev) {
        ev.preventDefault();
        $('.results').hide();
        activarLogoCarga();
        if ($('#PRSN_document').val() !== "") {
            $.ajax({
                url: '../persons/searchPersonWithUsers',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data, xhr) {
                    cerrarLogoCarga();

                    const response = JSON.parse(data);

                    const aplications = response.data
                    const infoUser = response.info
                    const cases = response.cases
                    crearAlerta('Usuario encontrado', 'success');

                    if (aplications.length) {
                        var dt = $('#table_users');
                        
                        if (dt.DataTable()) {
                            dt.DataTable().destroy();
                        }
                        dt.empty();
                        dt.off('click', 'td.dt-control')

                        $('.results').css('display', 'flex');
                        $('.form_consult').hide();

                        // Initialize or refresh the DataTable
                        dt.DataTable({
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
                            columns: [
                                { title: 'ID', data: 'ID' },
                                { title: 'APP', data: 'APLICATIVO' },
                                { title: 'NOMBRE', data: 'NOMBRE' },
                                { title: 'USUARIO', data: 'USUARIO' },
                                { title: 'ESTADO', data: 'ACTIVO' },
                                { title: 'CORREO ELECTRONICO', data: 'CORREO_ELECTRONICO', visible: false },
                                { title: 'ROLES', data: 'ROLES', visible: false },
                                { title: 'CARGO', data: 'CARGO', visible: false },
                                { title: 'NOMBRE INACTIVO', data: 'NOMBRE_INACTIVO', visible: false },
                                {
                                    className: 'dt-control',
                                    orderable: false,
                                    data: null,
                                    defaultContent: ''
                                },
                            ],
                            data: aplications
                        });

                        // Rebind the click event to handle row expand/collapse
                        dt.on('click', 'td.dt-control', function (e) {
                            let tr = e.target.closest('tr');
                            let row = dt.DataTable().row(tr);

                            if (row.child.isShown()) {
                                // This row is already open - close it
                                row.child.hide();
                            } else {
                                // Open this row
                                row.child(format(row.data())).show();
                            }
                        });



                    }

                    if(infoUser) {
                        $('#PRSN_name').val(infoUser.PRSN_name)
                        $('#PRSN_document_1').val(infoUser.PRSN_document)
                        $('#PRSN_email').val(infoUser.PRSN_email)
                        $('#PRSN_phone').val(infoUser.PRSN_phone)
                        $('#PRSN_position').val(infoUser.PRSN_position)
                    }

                    if(cases.length) {
                        var dtcases = $('#table_cases');

                        if (dtcases.DataTable()) {
                            dtcases.DataTable().destroy();
                        }

                        dtcases.empty();
                        
                        dtcases.DataTable({
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
                            columns: [
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
                                { title:'APP',data: 'APPS_name', },
                                { title:'F.RECEPCIÓN',data: 'CASE_date_reception' },
                                { title:'F.SOLUCIÓN',data: 'CASE_date_solution' },
                            ],
                            data: cases
                        });
                    }
                },
                error: function (xhr) {
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                    cerrarLogoCarga();
                },
            });
        } else {
            crearAlerta('POR FAVOR INGRESAR DATOS PARA PODER REALIZAR LA BUSQUEDA', 'error');
            cerrarLogoCarga();
        }

    });

    $('.copy-btn').on("click", function() {
        // Get the input field next to the clicked button
        var textToCopy = $(this).siblings('input')[0];  // Gets the corresponding input element

        // Use the Clipboard API to copy the text
        navigator.clipboard.writeText(textToCopy.value)
            .then(function() {
                crearAlerta('Texto copiado al portapapeles!', 'success');
            })
            .catch(function(err) {
                crearAlerta('Error al copiar el texto.', 'error');
            });
    });
});

$(document).ready(function () {

    $("#frm_consult_fud").submit(function (ev) {
        ev.preventDefault();

        if ($('#FUD_number').val() !== "") {
            $.ajax({
                url: '../fud/searchFud',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data, xhr) {
                    cerrarLogoCarga();

                    const response = JSON.parse(data);

                    const audit = response.auditFud
                    const cases = response.cases
                    const infoFud = response.info[0]



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
                                { title:'F.RECEPCIÓN',data: 'CASE_date_reception.date',
                                    render: function (data) {
                                        const date = new Date(data);
                                        const formattedDate = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                                        return `<span>${formattedDate}</span>`;
                                } 
                                 },
                                { title:'F.SOLUCIÓN',data: 'CASE_date_solution.date',
                                    render: function (data) {
                                        const date = new Date(data);
                                        const formattedDate = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                                        return `<span>${formattedDate}</span>`;
                                } 
                                 },
                            ],
                            data: cases
                        });
                    }





                    if(infoFud) {
                        $('#FUD_NUMBER').val(infoFud.FUD_NUMBER)
                        $('#FUD_ESTADO').val(infoFud.FUD_ESTADO)
                        $('#FUD_DATEREGISTER').val(infoFud.FUD_DATEREGISTER)
                        $('#ID_DECLARACION').val(infoFud.ID_DECLARACION)
                        $('#FUD_DATEDECLARACION').val(infoFud.FUD_DATEDECLARACION)
                        $('#FUD_VALORADOR').val(infoFud.FUD_VALORADOR)
                        $('#FUD_USUARIO').val(infoFud.FUD_USUARIO)
                    }


                    if(audit.length) {
                        var dtaudit = $('#table_audit');

                        if (dtaudit.DataTable()) {
                            dtaudit.DataTable().destroy();
                        }

                        dtaudit.empty();

                        dtaudit.DataTable({
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
                                { title:'ID',data: 'ID' , visible: false},
                                { title:'ESTADO',data: 'PARAM_ESTADO', },
                                { title:'FECHA ASIGNACION',data: 'FECHA_ASIGNACION', },
                                { title:'ID RESPONSABLE',data: 'ID_USUARIO_RESPONSABLE', },
                                { title:'RESPONSABLE',data: 'RESPONSABLE', },
                                { title:'NOMBRE',data: 'NOMBRE', },
                            ],
                            data: audit
                        });
                    }

                    $('.results').css('display', 'flex');
                    $('.form_consult').hide();

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


});

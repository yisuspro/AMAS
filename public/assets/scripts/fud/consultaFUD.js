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
                    const infoAA = response.infoAA
                    const infoConsecutive = response.infoConsecutive



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
                                //{ title:'',data: 'PARAM_ESTADO', },
                                { title:'FECHA ASIGNACION',data: 'FECHA_ASIGNACION', },
                                //{ title:'ID RESPONSABLE',data: 'ID_USUARIO_RESPONSABLE', },
                                { title:'RESPONSABLE',data: 'RESPONSABLE', },
                                { title:'ESTADO',data: 'NOMBRE', },
                            ],
                            data: audit
                        });
                    }

                    if(infoAA.length){
                        var table_siravAA = $('#table_siravAA');

                        if (table_siravAA.DataTable()) {
                            table_siravAA.DataTable().destroy();
                        }

                        table_siravAA.empty();

                        table_siravAA.DataTable({
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
                                //{ title:'ID',data: 'ID' , visible: false},
                                { title:'CodigoDeclaracion',data: 'CodigoDeclaracion'},
                                { title:'Fecha Valoracion',data: 'Dia_Valoracion',
                                    render: function (data, type, row, meta) {
                                        return `<span>${row.Dia_Valoracion} ${row.Mes_Valoracion} ${row.Año_Valoracion}</span>`; }
                                },
                                { title:'ESTADO',data: 'ESTADO', },
                                { title:'Resolucion',data: 'Resolucion', },
                                { title:'ORFEO RESOLUCION',data: 'ORFEO_RESOLUCION', },
                                { title:'RESPONSABLE',data: 'PRIMER_NOMBRE', 
                                     render: function (data, type, row, meta) {
                                        //const date = new Date(data);
                                        //const formattedDate = `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
                                        return `<span>${row.PRIMER_NOMBRE} ${row.SEGUNDO_NOMBRE} ${row.PRIMER_APELLIDO} ${row.SEGUNDO_APELLIDO}</span>`; }
                                },
                                { title:'Observaciones',data: 'Observaciones', },                                
                            ],
                            data: infoAA
                        });
                        /*
                            $('#AA_CodigoDeclaracion').val(infoAA.CodigoDeclaracion)
                            $('#AA_FechaValoracion').val(infoAA.Dia_Valoracion+'  '+infoAA.Mes_Valoracion+'  '+infoAA.Año_Valoracion)
                            $('#AA_Estado').val(infoAA.ESTADO)
                            $('#AA_Resolucion').val(infoAA.Resolucion)
                            $('#AA_OrfeoResolucion').val(infoAA.ORFEO_RESOLUCION)
                            $('#AA_Nombre').val(infoAA.PRIMER_NOMBRE+'  '+infoAA.SEGUNDO_NOMBRE+'  '+infoAA.PRIMER_APELLIDO+'  '+infoAA.SEGUNDO_APELLIDO)
                            $('#AA_Observaciones').val(infoAA.Observaciones)
                        */
                        
                        
                        $('.sirav-panel').css('display', 'flex');
                    } else{
                        $('.sirav-panel').css('display', 'none');
                    }


                    if(infoConsecutive.length){
                        var table_siravConsecutive = $('#table_siravConsecutive');

                        if (table_siravConsecutive.DataTable()) {
                            table_siravConsecutive.DataTable().destroy();
                        }

                        table_siravConsecutive.empty();

                        table_siravConsecutive.DataTable({
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
                                //{ title:'ID',data: 'ID' , visible: false},
                                { title:'usuarioSolicitud',data: 'usuarioSolicitud'},                                
                                { title:'NumeroResolucion',data: 'NumeroResolucion'},                                
                                { title:'fechaAsignado',data: 'fechaAsignado'},                                
                                { title:'Estado',data: 'Activo'},                                
                                { title:'Declarante',data: 'Declarante'},                                
                                { title:'Nombre',data: 'Nombre'},                                
                            ],
                            data: infoConsecutive
                        });
                        
                        
                        //$('.sirav-panel').css('display', 'flex');
                    } else{
                        //$('.sirav-panel').css('display', 'none');
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

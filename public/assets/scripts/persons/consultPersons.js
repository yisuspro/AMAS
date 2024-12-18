$(document).ready(function () {
    function format(d) {
        // `d` is the original data object for the row
        return ('<dl><dt>ROLES:</dt>' +
            '<dd>' +
            d.ROLES +
            '</dd>' +
            '<dt>CARGO:</dt>' +
            '<dd>' +
            d.CARGO +
            '</dd>' +
            '<dt>FECHA INACTIVACION:</dt>' +
            '<dd>' +
            d.FECHA_INACTIVACION +
            '</dd>' +
            '<dt>FECHA ULTIMO ACCESO:</dt>' +
            '<dd>' +
            d.FECHALOGEADO +
            '</dd>' + '</dl>');
    }

    $("#frm_consult_users").submit(function (ev) {
        ev.preventDefault();
        $('.results').hide();
        activarLogoCarga();
        if ($('#PRSN_document').val() !== "" || $('#PRSN_name').val() !== "") {
            var data = {
                PRSN_document: $('#PRSN_document').val(),
                PRSN_name: $('#PRSN_name').val()
            }

            $.ajax({
                url: '../persons/searchPersonWithUsers',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data, xhr) {
                    cerrarLogoCarga();

                    const aplications = JSON.parse(data);
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
                                bottomEnd: '',
                                bottom2Start: 'info',
                                bottom2End: 'paging'
                            },
                            columns: [
                                {
                                    className: 'dt-control',
                                    orderable: false,
                                    data: null,
                                    defaultContent: ''
                                },
                                { title: 'ID', data: 'ID' },
                                { title: 'APLICATIVO', data: 'APLICATIVO' },
                                { title: 'NOMBRE', data: 'NOMBRE' },
                                { title: 'IDENTIFICACION', data: 'IDENTIFICACION' },
                                { title: 'USUARIO', data: 'USUARIO' },
                                { title: 'ACTIVO', data: 'ACTIVO' },
                                { title: 'CORREO ELECTRONICO', data: 'CORREO_ELECTRONICO', visible: false },
                                { title: 'ROLES', data: 'ROLES', visible: false },
                                { title: 'CARGO', data: 'CARGO', visible: false },
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

                },
                error: function (xhr) {
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                    cerrarLogoCarga();
                    console.log(xhr + 'hola')
                },
            });
        } else {
            crearAlerta('POR FAVOR INGRESAR DATOS PARA PODER REALIZAR LA BUSQUEDA', 'error');
            cerrarLogoCarga();
        }

    });
});

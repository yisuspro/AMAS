
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
                '</dd>'+
                '<dt>FECHA ULTIMO ACCESO:</dt>' +
                '<dd>' +
                d.FECHALOGEADO +
                '</dd>' +'</dl>' 
            );
        }
        var tipo = $('#TIPO').val();
        var parametro = $('#PARAMETRO').val();
        var dt;
        dt = $('#table_ruv');
        dt.DataTable({
            info: false,
            ordering: false,
            paging: false,
            searching: false,
            dom: null,
            order: [
                [6, 'asc']
            ],
            scrollX: true,
            ajax: {
                url: "../Ruv/listUser/" + tipo + "/" + parametro,
                type: 'GET'
            },
            columns: [
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                { data: 'ID' },
                { data: 'NOMBRE' },
                { data: 'IDENTIFICACION' },
                { data: 'USUARIO' },
                { data: 'CORREO_ELECTRONICO' },
                { data: 'ACTIVO' },
                { data: 'ROLES', visible: false },
                { data: 'CARGO', visible: false },
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

            ],
            layout: {
                top: 'buttons',
            },

            rowCallback: function (row, data) {

                if (data['ACTIVO'] == 1) {
                    $($(row).find("td")[6]).html("<p class='text-success'>ACTIVO</p>");
                } else if (data['ACTIVO'] == 0) {
                    $($(row).find("td")[6]).html("<p class='text-danger'>INACTIVO</p>");
                } else {
                    $($(row).find("td")[6]).html("<p class='text-warning'>SIN ESTADO</p>");
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
                row.child(format(row.data())).show();
            }
        });


    }


});


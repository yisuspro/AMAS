$(document).ready(function () {



    $('#loadingBtn').on('click', function () {
        var formData = new FormData($('#frm_loading_censo')[0]);
        activarLogoCarga();
        $.ajax({
            url: '../Vivanto/loadingFileCenso',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data, xhr, response) {
                cerrarLogoCarga();
                crearAlerta('carga exitosa', 'success');
                data = JSON.parse(data);
                console.log(data)

              
                let table = '<table border="1"><tr>';
                table += '<th>ID Censo</th>';
                table += '<th>Fecha Censo</th>';
                table += '<th>Ent ID</th>';
                table += '<th>Tipo Censo</th>';
                table += '<th>Num Doc</th>';
                table += '<th>Nombre 1</th>';
                table += '<th>Nombre 2</th>';
                table += '<th>Apellido 1</th>';
                table += '<th>Apellido 2</th>';
                table += '<th>Cargo Rela</th>';
                table += '<th>Mail</th>';
                table += '<th>Móvil</th>';

                table += '</tr>';

                data.forEach(function (row) {
                    table += '<tr>';
                    table += '<td>' + row.P_CS_ID + '</td>';
                    table += '<td>' + row.P_F_CENSO + '</td>';
                    table += '<td>' + row.P_ENT_ID + '</td>';
                    table += '<td>' + row.P_PMT_TIPO_CENSO + '</td>';
                    table += '<td>' + row.P_NUM_DOC + '</td>';
                    table += '<td>' + row.P_NOM1 + '</td>';
                    table += '<td>' + row.P_NOM2 + '</td>';
                    table += '<td>' + row.P_APE1 + '</td>';
                    table += '<td>' + row.P_APE2 + '</td>';
                    table += '<td>' + row.P_CARGO_RELA + '</td>';
                    table += '<td>' + row.P_MAIL + '</td>';
                    table += '<td>' + row.P_MOVIL + '</td>';

                    table += '</tr>';
                });
                table += '</table>';

                // Insertar la tabla en el contenedor
                $('#dataContainer').html(table);

            },
            error: function (xhr, response) {

                var json = JSON.parse(xhr.responseText);
                crearAlerta(json, 'error');
                cerrarLogoCarga();
                console.log(xhr.responseText + 'hola')
                console.log(response.responseText + 'hola')
            },

        });
    });

    $("#back").on('click', function (e) {
        activarLogoCarga();
        e.preventDefault();
        $(".area-trabajo").load('listUsersView', function () {
            cerrarLogoCarga();
        });
    });


});
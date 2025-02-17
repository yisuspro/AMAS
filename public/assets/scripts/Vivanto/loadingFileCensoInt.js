$(document).ready(function () {



    $('#loadingBtn').on('click', function () {
        var formData = new FormData($('#frm_loading_censo')[0]);
        activarLogoCarga();
        $.ajax({
            url: '../Vivanto/loadingFileCensoInt',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data, xhr, response) {
                cerrarLogoCarga();
                crearAlerta('Carga exitosa', 'success');
                console.log(data)
                data = JSON.parse(data);
                console.log(data)
             
                let table = '<table border="1"><tr>';
                table += '<th>ID INTEGRANTE</th>';
                table += '<th>NUMERO DOCUMENTO</th>';
                table += '</tr>';

                
                data.forEach(function (row) {
                    table += '<tr>';
                    table += '<td>' + row.CSI_ID + '</td>';
                    table += '<td>' + row.P_NUM_DOC + '</td>';
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
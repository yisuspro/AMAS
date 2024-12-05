$(document).ready(function () {



    $('#loadingBtn').on('click', function () {
        var formData = new FormData($('#frm_loading_censo')[0]);
        activarLogoCarga();
        $.ajax({
            url: '../Vivanto/loadingFileCensoUbica',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data, xhr, response) {
                cerrarLogoCarga();
                crearAlerta('carga exitosa', 'success');
                console.log(data)
                data = JSON.parse(data);
                console.log(data)
             
                let table = '<table border="1"><tr>';
                table += '<th>ID UBIC CENSO</th>';
                table += '<th>ID CENSO</th>';
                table += '</tr>';

                
                data.forEach(function (row) {
                    table += '<tr>';
                    table += '<td>' + row.P_CSU_ID + '</td>';
                    table += '<td>' + row.P_CS_ID + '</td>';
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
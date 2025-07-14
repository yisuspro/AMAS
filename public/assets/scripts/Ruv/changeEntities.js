$(document).ready(function () {
    $("#frm_consult_fud_entities").submit(function (ev) {
        ev.preventDefault(); 
        activarLogoCarga();
        $('#frm_set_entity').hide();

        if ($('#numeroformulario').val() !== "") { 
            $.ajax({
                url: '../Ruv/searchEntity',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data, xhr) {
                    const response = JSON.parse(data);
                    $('#contenedor-entidades').empty();

                    const selectHTML = `
                        <input type="hidden" value="${$('#numeroformulario').val()}" id="numdeclaracion" name="numdeclaracion">
                        <label for="entidad" class="form-label">Seleccione entidad:</label>
                        <select class="form-control" id="entidad" name="entidad">
                            ${response.map(item => 
                                `<option value="${item.ID}" ${item.ID === item.ID_ENTIDADMUNICIPIODECLARACION ? 'selected' : ''}>
                                    ${item.NOMBRE}
                                </option>`
                            ).join('')}
                        </select>
                    `;
                
                    $('#contenedor-entidades').html(selectHTML);
                    $('#frm_set_entity').show();
                    cerrarLogoCarga();
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
    
    
    })

    $("#frm_set_entity").submit(function (ev) {
        ev.preventDefault(); 
        activarLogoCarga();

        if ($('#entidad-select').val() !== "") { 
            $.ajax({
                url: '../Ruv/changeEntity',
                type: 'POST',
                data: $(this).serialize(),
                success: function (data, xhr) {
                    cerrarLogoCarga();
                    $('#contenedor-entidades').empty();
                    $('#frm_set_entity').hide();
                    crearAlerta('Entidad actualizada correctamente', 'success');
                },
                error: function (xhr) {
                    var json = JSON.parse(xhr.responseText);
                    crearAlerta(json, 'error');
                    cerrarLogoCarga();
                },
            });

        }

    })

});
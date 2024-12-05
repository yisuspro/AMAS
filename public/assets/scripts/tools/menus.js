
// --------------------- acordeon -------------------------------
document.addEventListener("DOMContentLoaded", function() {

    var items = document.querySelectorAll('.buton-menu-padre');
    

    function toggleAccordion(item) {
        var id = item.id;
        // Alternar la clase activa para el panel y mostrar/ocultar el contenido
        item.classList.toggle('activo');
        
        var hijo = document.getElementById("contenido" + id);
        if (item.classList.contains('activo')) {
            $(hijo).removeClass("oculto");
            hijo.style.display = 'flex';
        } else {
            $(hijo).addClass('oculto');
            hijo.style.display = 'none';
        }
    }

    items.forEach(function(item) {
        item.addEventListener('click', function() {
            toggleAccordion(item);
        });
    });

    // Exponer la función toggleAccordion para uso externo
    window.toggleAccordion = toggleAccordion;
});
// --------------------- acordeon -------------------------------
$(document).ready(function() {
   

    $(".buton-menu-hijo").on('click', function(e) {
        activarLogoCarga();
        e.preventDefault();
        var url = $(this).attr("id");
        $(".area-trabajo").load(url, function(){
            cerrarLogoCarga();
        });
        // Cerrar el acordeón correspondiente
        var parentItem = $(this).closest('.buton-menu-padre')[0];
        if (parentItem) {
            window.toggleAccordion(parentItem);
        }
        
    });


});
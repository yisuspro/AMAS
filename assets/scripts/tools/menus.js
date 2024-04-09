
// --------------------- acordeon -------------------------------
document.addEventListener("DOMContentLoaded", function() {

    var items = document.querySelectorAll('.buton-menu-padre');
    

    items.forEach(function(item) {
        

        item.addEventListener('click', function() {
            var id = item.id;
            // Alternar la clase activa para el panel y mostrar/ocultar el contenido
            var subMenu = document.getElementById(id);
            item.classList.toggle('activo');
            
            var hijo = document.getElementById("contenido"+id);
            if (item.classList.contains('activo')) {
                $(hijo).removeClass("oculto")
                hijo.style.display = 'flex';
            } else {
                $(hijo).addClass('oculto');
                hijo.style.display = 'none';
            }
            
            
        });
    });
});
// --------------------- acordeon -------------------------------
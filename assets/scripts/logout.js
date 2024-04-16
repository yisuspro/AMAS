$(document).ready(function() {
    // Manejar el clic en el botón de cerrar sesión
    $("#cerrarSesion").click(function() {
        // Enviar solicitud AJAX para cerrar sesión
        $.ajax({
            url: "logout", // Ruta al script de cierre de sesión en tu servidor
            method: "POST",
            success: function(response) {
               alert('sesion cerrada')
                // Redirigir a la página de inicio de sesión u otra página después de cerrar sesión
                window.location.href = "/amas/users"; 
                
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error("Error al cerrar sesión:", error);
            }
        });
    });
});
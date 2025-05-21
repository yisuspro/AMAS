$(document).ready(function() {
    // Manejar el clic en el botón de cerrar sesión
    $("#cerrarSesion").on("click", function() {
        // Mostrar un cuadro de confirmación antes de cerrar sesión
        if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
            // Enviar solicitud AJAX para cerrar sesión
            $.ajax({
                url: "logout", // Ruta al script de cierre de sesión en tu servidor
                method: "POST",
                success: function(response) {
                    // alert('Sesión cerrada con éxito');
                    // Redirigir a la página de inicio de sesión u otra página después de cerrar sesión
                    setTimeout(function() {
                        window.location.href = "/"; // Cambiar la ruta si es necesario
                    }, 2000); // Redirige después de 2 segundos
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error("Error al cerrar sesión:", error);
                    alert('Hubo un error al cerrar sesión. Por favor, inténtalo de nuevo.');
                }
            });
        }
    });
});

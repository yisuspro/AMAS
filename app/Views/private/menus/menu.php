<nav>
    <div class="header--title">
         <span id="currentDate"></span><br>
         <script>
            function updateDateTime() {
                const date = new Date();
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                };
                const currentDate = date.toLocaleDateString('es-CO', options);
                const currentTime = date.toLocaleTimeString('es-CO');
                document.getElementById("currentDate").innerHTML = "Fecha y hora actual: " + currentDate + " " + currentTime;
            }
            
            updateDateTime();
            setInterval(updateDateTime, 120000);
        </script>

        <div class="text-primary">Sistema Unificado de Servicios de la Información</div>
    </div>
    <div class="botones-menu-sup">      
         <!-- Otros elementos del menú -->
        <p>Hola, <?= session()->get('USER_name') ?></p>
        <a class="logout-boton" id="cerrarSesion"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</nav>
<div class="line-header">
    <div class="line-yellow"></div>
    <div class="line-blue"></div>
    <div class="line-red"></div>
</div>

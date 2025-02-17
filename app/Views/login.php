<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url('assets/images/logo/image1.ico'); ?>" type="image/png"/>
        <link href="<?= base_url('assets/styles/login.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets/styles/tools/alertas.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url('assets/scripts/jquery.min.js'); ?>"></script>
        <link href="<?= base_url('assets/styles/tools/tools.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="row login-page m-0">
            <div class="col-6 banner-section">
            <h1  class="text-center susi"><?= lang("General.appName") ?></h1>    
            <h3  class="text-center"> Sistema Unificado de Servicios de la Información </h3>
            <div class="img-login">

            </div>    
            </div>
            <div class="col-6 form-section">
                <div class="img-unidad"></div>
                <h3 class="text-center title fw-bolder">Inicio sesión</h3>
                <h5 class="text-center fw-lighter mb-5">Ingresa tus credenciales</h5>
                <form method="post" action="<?= base_url('users/login'); ?>" id="frm_login">
                    <div class="mb-3">
                        <label class="form-label"><?= lang("General.user") ?></label>
                        <input id="USER_username" type="text" name="USER_username" class="form-control" required>
                    </div>
                    <div class="mb-3 mt-4">
                        <label class="form-label">Contraseña:</label>
                        <input id="USER_password" type="password" name="USER_password" class="form-control" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login mt-4">Ingresar</button>
                    </div>
                </form>
                <p class="text-center hidden">¿Olvidó su contraseña?</p>
            </div>
        </div>
        <div class="alerta hidden" id="alerta">
            <div class="contAlerta" id="contAlerta"></div>
            <button class="btn_close"><i class="bi bi-x"></i></button>
        </div>

        <script src="<?= base_url('assets/scripts/login.js'); ?>"></script>
        <script src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
    </body>
</html>

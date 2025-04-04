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
        <div class="row m-0 resetpassword-page">
            <div class="col-6 banner-section">
                <h1  class="text-center susi"><?= lang("General.appName") ?></h1>    
                <h3  class="text-center"> Sistema Unificado de Servicios de la Información </h3>
                <div class="img-login"></div>  
            </div>
            <div class="col-6 form-section">
                <div class="img-unidad"></div>
                <h3 class="text-center title fw-bolder">Cambio de contraseña</h3>
                <form method="post" action="#" id="frm_update_password_user">
                    <input type="hidden" name="USER_PK_P" class="form-control" value="<?= $USER_PK ?? 0 ?>">
                    <div class="mb-3">
                        <label class="form-label">Contraseña Actual</label>
                        <input type="password" name="USER_password_A" class="form-control" placeholder="Contraseña actual" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña Nueva</label>
                        <input type="password" name="USER_password_P" class="form-control" placeholder="Nueva contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="USER_password_two_P" class="form-control" placeholder="Repetir contraseña" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-block">CAMBIAR CONTRASEÑA</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="alerta hidden" id="alerta">
            <div class="contAlerta" id="contAlerta"></div>
            <button class="btn_close">X</button>
        </div>

        <script src="<?= base_url('assets/scripts/UpdatePasswordUser.js'); ?>"></script>
        <script src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
    </body>

</html>
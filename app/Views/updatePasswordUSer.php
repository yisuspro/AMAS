<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/images/logo/image1.ico'); ?>" type="image/png" />
    <link href="<?= base_url('assets/styles/login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/styles/tools/alertas.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/scripts/jquery.min.js'); ?>"></script>
    <link href="<?= base_url('assets/styles/tools/tools.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body class="body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"><?= lang("General.appName") ?></a>
    </nav>

    <div class="container">
        <div class="col-4 section">
            <h3 class="titulo"><?= $title ?? 'Mi Aplicación' ?></h3>
            <form method="post" action="#" id="frm_update_password_user">
                <div class="mb-3">
                    <label class="form-label">Id <?= lang("General.user") ?></label>
                    <input type="text" name="USER_PK_P" class="form-control" value="<?= $USER_PK ?? 0 ?>" readonly>
                </div>
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
                <button type="submit" class="btn btn-success btn-block">CAMBIAR CONTRASEÑA</button>
            </form>
        </div>

        <div class="alerta hidden" id="alerta">
            <div class="contAlerta" id="contAlerta"></div>
            <button class="btn_close">X</button>
        </div>
    </div>

    <script src="<?= base_url('assets/scripts/UpdatePasswordUser.js'); ?>"></script>
    
    <script src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
</body>

</html>
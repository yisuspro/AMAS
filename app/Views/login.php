<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?= base_url('assets/images/logo/image1.ico'); ?>" type="image/png"/>
        <link href="<?= base_url('assets/styles/login.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url('assets/styles/tools/alertas.css'); ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= base_url('assets/scripts/jquery.min.js'); ?>"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body class="body">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
              <a class="navbar-brand"><?= lang("General.appName") ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        </nav>

        <div class="container">
            <div class="col-4 section">
                <h3 class="titulo">INICIO SESIÓN</h3>
                <form method="post" action="<?= base_url('users/login'); ?>" id="frm_login">
                    <div class="mb-3">
                        <label class="form-label"><?= lang("General.user") ?></label>
                        <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="<?= lang("General.user") ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña:</label>
                        <input id="USER_password" type="password" name="USER_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Ingresar</button>
                </form>
            </div>

            <div class="alerta hidden" id="alerta">
                <div class="contAlerta" id="contAlerta"></div>
                <button class="btn_close">X</button>
            </div>
        </div>

        <script src="<?= base_url('assets/scripts/login.js'); ?>"></script>
        <script src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
    </body>
</html>

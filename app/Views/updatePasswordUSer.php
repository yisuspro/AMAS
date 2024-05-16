<html>

<head>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo/image1.ico'); ?>">
    <link href="<?= base_url('assets/styles/login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/styles/tools/alertas.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= base_url('vendor/components/jquery/jquery.js'); ?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>

<body class="body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">AMAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container">
        <div class="col-4 section">
            <div class="titulo">
                <h3><?= $title ?? 'Mi Aplicación' ?></h3>
            </div>
            <form method="post" action="#" id="frm_update_password_user">

                    <div class="mb-3">
                        <label class="form-label">Id usuario</label>
                        <input id="USER_PK_P" type="text" name="USER_PK_P" class="form-control" placeholder="usuario" value="<?= $USER_PK ?? 0 ?>" readonly>
                    </div>
                
                <div class="mb-3">
                    <label class="form-label">Contraseña Actual</label>
                    <input id="USER_password_A" type="password" name="USER_password_A" class="form-control" placeholder="Nueva contraseña" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña Nueva</label>
                    <input id="USER_password_P" type="password" name="USER_password_P" class="form-control" placeholder="Nueva contraseña" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmar Contraseña</label>
                    <input id="USER_password_two_P" type="password" name="USER_password_two_P" class="form-control" placeholder="Repetir contraseña" required>
                </div>

                <button type="submit" class="btn btn-success btn-block">CAMBIAR CONTRASEÑA</button>
            </form>
        </div>

        <div class="alerta hidden" id="alerta">
            <div class="contAlerta" id="contAlerta"></div>
            <button class="btn_close">X</button>
        </div>
    </div>

</body>

<script type="text/javascript" src="<?= base_url('assets/scripts/UpdatePasswordUser.js'); ?>"></script>



</html>
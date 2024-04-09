
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo/image1.ico'); ?>">
    <title><?= $title ?? 'Mi Aplicación' ?></title>
    <!-- Enlaces a archivos CSS, JS, etc. -->
    
    <link href="<?= base_url('assets/styles/tools/alertas.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/styles/tools/menus.css'); ?>" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?= base_url('vendor/components/jquery/jquery.js'); ?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    

</head>
<body>
    <!-- Incluir el menú -->
    <?= $this->include('private/menus/menu_lateral') ?>
    <div class="contenedor">
    <?= $this->include('private/menus/menu') ?>
    <!-- Contenido -->
    <div class="area-trabajo">
        <?= $this->renderSection('content') ?>
    </div>
    </div>
    
    <!-- Footer u otras secciones comunes -->
</body>
<script type="text/javascript" src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/scripts/tools/menus.js'); ?>"></script>
</html>
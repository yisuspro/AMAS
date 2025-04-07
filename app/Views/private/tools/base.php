<!DOCTYPE html>
<html lang="es">

    <head>
        <?php if (!session()->get('USER_PK')) { ?>
            <script>
                window.location.replace('<?= base_url('users'); ?>');
            </script>
        <?php } ?>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo/image1.ico'); ?>">
        <title><?= $title ?? 'Mi Aplicación' ?></title>
        <!-- Enlaces a archivos CSS, JS, etc. -->
        <link href="<?= base_url('assets/styles/tools/tools.css'); ?>" rel="stylesheet" type="text/css" />


        <script type="text/javascript" src="<?= base_url('assets/scripts/jquery.min.js'); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

        
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.3/js/dataTables.jqueryui.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.jqueryui.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.colVis.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.js"></script>
        <script src="https://cdn.datatables.net/colreorder/2.0.0/js/dataTables.colReorder.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.js"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
        <script src="https://cdn.datatables.net/keytable/2.12.0/js/dataTables.keyTable.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.jqueryui.js"></script>
        <script src="https://cdn.datatables.net/rowgroup/1.5.0/js/dataTables.rowGroup.js"></script>
        <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
        <script src="https://cdn.datatables.net/scroller/2.4.1/js/dataTables.scroller.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.7.0/js/dataTables.searchBuilder.js"></script>
        <script src="https://cdn.datatables.net/searchbuilder/1.7.0/js/searchBuilder.jqueryui.js"></script>
        <script src="https://cdn.datatables.net/searchpanes/2.3.0/js/dataTables.searchPanes.js"></script>
        <script src="https://cdn.datatables.net/searchpanes/2.3.0/js/searchPanes.jqueryui.js"></script>
        <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.js"></script>
        <script src="https://cdn.datatables.net/staterestore/1.4.0/js/dataTables.stateRestore.js"></script>
        <script src="https://cdn.datatables.net/staterestore/1.4.0/js/stateRestore.jqueryui.js"></script>

        <!-- tablas ajax -->
    </head>

    <body>
        <div class="pantalla-carga oculto">
            <div class="icono-carga">
            </div>
        </div>
        <div class="alerta hidden" id="alerta">
            <div class="contAlerta" id="contAlerta"></div>
            <button class="btn_close">X</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!--<button class="boton-prueba">prueba</button> -->
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
    <script type="text/javascript" src="<?= base_url('assets/scripts/tools/logo_carga.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/scripts/tools/alertas.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/scripts/tools/menus.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/scripts/logout.js'); ?>"></script>

</html>
<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">
        <table id="listPermissions" class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID PERMISOS</th>
                    <th>NOMBRE</th>
                    <th><?= strtoupper(lang("General.description")) ?></th>
                    <th>NOMBRE CORTO</th>
                    <th>ESTADO</th>
                    <th>F.CREACION</th>
                    <th>F.MODIFICACION</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>ID PERMISOS</th>
                    <th>NOMBRE</th>
                    <th><?= strtoupper(lang("General.description")) ?></th>
                    <th>NOMBRE CORTO</th>
                    <th>ESTADO</th>
                    <th>F.CREACION</th>
                    <th>F.MODIFICACION</th>
                    <th>ACCIONES</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPermissionModalLabel">CREAR PERMISO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="#" id="frm_create_permission">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Nombre permiso</label>
                        <input id="PRMS_name" type="text" name="PRMS_name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_description" class="form-label"><?= lang("General.description") ?></label>
                        <input id="PRMS_description" type="text" name="PRMS_description" class="form-control" placeholder="<?= lang("General.description") ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_system_name" class="form-label">Nombre corto</label>
                        <input id="PRMS_system_name" type="text" name="PRMS_system_name" class="form-control" placeholder="Nombre corto" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Crear</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/Permissions/createPermissions.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/scripts/Permissions/listPermissions.js'); ?>"></script>
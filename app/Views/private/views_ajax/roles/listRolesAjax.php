<i class="bi bi-journal-text"><?= $title ?? 'Mi Aplicación' ?></i>
<div class="card datatable">
    <table id="listRoles" class="table table-hover" style="width:100%"></table>
</div>

<!-- Modal -->
<div class="modal fade" id="createRolesModal" tabindex="-1" aria-labelledby="createRolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRolesModalLabel">CREAR ROLES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="#" id="frm_create_roles">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ROLE_name" class="form-label">Nombre rol</label>
                        <input id="ROLE_name" type="text" name="ROLE_name" class="form-control" placeholder="Nombre rol" required>
                    </div>
                    <div class="mb-3">
                        <label for="ROLE_description" class="form-label"><?= lang("General.description") ?></label>
                        <input id="ROLE_description" type="text" name="ROLE_description" class="form-control" placeholder="<?= lang("General.description") ?>" required>
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

<script type="text/javascript" src="<?= base_url('assets/scripts/Roles/createRoles.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/scripts/Roles/listRoles.js'); ?>"></script>

<div class="breadcrumb">
    <div class="element">Roles</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>
<div class="card">
        <div class="card-body">
        <form method="post" action="#" id="frm_update_role">
            <div class="mb-3">
                <label class="form-label">ID Permiso</label>
                <input id="ROLE_PK" type="number" name="ROLE_PK" value="<?= $data->ROLE_PK ?? 0 ?>" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre Rol</label>
                <input id="ROLE_name" type="text" name="ROLE_name" value="<?= $data->ROLE_name ?? '' ?>" class="form-control" placeholder="Nombre rol" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><?= lang("General.description") ?></label>
                <input id="ROLE_description" type="text" name="ROLE_description" value="<?= $data->ROLE_description ?? '' ?>" class="form-control" placeholder="<?= lang("General.description") ?>" required>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-block">Modificar</button>
                <button type="button" class="btn btn-danger" id="back" name="back">Atrás</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/roles/updateRoles.js'); ?>"></script>

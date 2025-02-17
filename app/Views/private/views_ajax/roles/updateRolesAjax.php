<div class="breadcrumb">
    <div class="element">Roles</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>
<form method="post" action="#" id="frm_update_role">
    <div class="card">
        <div class="card-header">
            Actualizar <?= $data->ROLE_name ?? 'Rol' ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col col-6">
                    <div class="mb-3">
                        <label class="form-label">ID Rol</label>
                        <input id="ROLE_PK" type="number" name="ROLE_PK" value="<?= $data->ROLE_PK ?? 0 ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="col col-6">
                    
                    <div class="mb-3">
                        <label class="form-label">Nombre Rol</label>
                        <input id="ROLE_name" type="text" name="ROLE_name" value="<?= $data->ROLE_name ?? '' ?>" class="form-control" placeholder="Nombre rol" required>
                    </div>
                </div>
                <div class="col col-12">
                    <div class="mb-3">
                        <label class="form-label"><?= lang("General.description") ?></label>
                        <input id="ROLE_description" type="text" name="ROLE_description" value="<?= $data->ROLE_description ?? '' ?>" class="form-control" placeholder="<?= lang("General.description") ?>" required>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="area-buttons">
            <button type="submit" class="btn btn-primary btn-block">Modificar usuario</button>
            <button type="button" class="btn btn-danger" id="back" name="back">Atras</button>
        </div>
</form>

<script type="text/javascript" src="<?= base_url('assets/scripts/roles/updateRoles.js'); ?>"></script>

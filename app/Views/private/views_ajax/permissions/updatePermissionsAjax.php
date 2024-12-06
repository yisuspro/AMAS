<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title ?? 'Seccion' ?></i>
    </div>
    
    <div class="seccion">
        <form method="post" action="#" id="frm_update_permission">
            <?php foreach ($data as $dataPermission) : ?>
                <div class="mb-3">
                    <label class="form-label">ID Permiso</label>
                    <input id="PRMS_PK" type="number" name="PRMS_PK" value="<?= $dataPermission['PRMS_PK'] ?? 0 ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre Permiso</label>
                    <input id="PRMS_name" type="text" name="PRMS_name" value="<?= $dataPermission['PRMS_name'] ?? '' ?>" class="form-control" placeholder="Nombre permiso" required>
                </div>
                <div class="mb-3">
                    <label class="form-label"><?= lang("General.description") ?></label>
                    <input id="PRMS_description" type="text" name="PRMS_description" value="<?= $dataPermission['PRMS_description'] ?? '' ?>" class="form-control" placeholder="<?= lang("General.description") ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre Corto</label>
                    <input id="PRMS_system_name" type="text" name="PRMS_system_name" value="<?= $dataPermission['PRMS_system_name'] ?? '' ?>" class="form-control" placeholder="Nombre corto" required>
                </div>
            <?php endforeach; ?>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block">Modificar</button>
                <button type="button" class="btn btn-danger" id="back" name="back">ATRÁS</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/Permissions/updatePermissions.js'); ?>"></script>

<div class="breadcrumb">
    <div class="element">Permisos</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Seccion' ?></div>
</div>

<form method="post" action="#" id="frm_update_permission">
    <div class="card">  
        <div class="card-header">
            <?= $title ?? 'Seccion' ?>
        </div> 
        <div class="card-body">
            <div class="row">
                <div class="col col-6">
                    <div class="mb-3">
                        <label class="form-label">ID Permiso</label>
                        <input id="PRMS_PK" type="number" name="PRMS_PK" value="<?= $data->PRMS_PK ?? 0 ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre Permiso</label>
                        <input id="PRMS_name" type="text" name="PRMS_name" value="<?= $data->PRMS_name ?? '' ?>" class="form-control" placeholder="Nombre permiso" required>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="mb-3">
                        <label class="form-label"><?= lang("General.description") ?></label>
                        <input id="PRMS_description" type="text" name="PRMS_description" value="<?= $data->PRMS_description ?? '' ?>" class="form-control" placeholder="<?= lang("General.description") ?>" required>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre Corto</label>
                        <input id="PRMS_system_name" type="text" name="PRMS_system_name" value="<?= $data->PRMS_system_name ?? '' ?>" class="form-control" placeholder="Nombre corto" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="area-buttons">
        <button type="submit" class="btn btn-success btn-block">Modificar</button>
        <button type="button" class="btn btn-danger" id="back" name="back">ATRÁS</button>
    </div>
</form>

<script type="text/javascript" src="<?= base_url('assets/scripts/Permissions/updatePermissions.js'); ?>"></script>

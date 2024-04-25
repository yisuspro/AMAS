<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title ?? 'Seccion' ?></i>
    </div>
    <div class="seccion">
        <form method="post" action="#" id="frm_update_role">
        <?php foreach ($data as $dataRoles): ?>
        <div class="mb-3">
                <label class="form-label">ID permiso</label>
                <input id="ROLE_PK" type="number" name="ROLE_PK" value="<?= $dataRoles['ROLE_PK'] ?? 0 ?>" class="form-control" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre permiso</label>
                <input id="ROLE_name" type="text" name="ROLE_name" value="<?= $dataRoles['ROLE_name'] ?? 0 ?>" class="form-control" placeholder="Nombre rol" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input id="ROLE_description" type="text" name="ROLE_description" value="<?= $dataRoles['ROLE_description'] ?? 0 ?>" class="form-control" placeholder="Descripcion" required>
            </div>
            
            <?php endforeach; ?>


            <button type="submit" class="btn btn-success btn-block">Modificar</button>
            <button type="button" class="btn btn-danger">Atras</button>

        </form>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/roles/updateRoles.js'); ?>"></script>
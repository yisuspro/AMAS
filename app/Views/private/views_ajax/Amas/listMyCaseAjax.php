<div class="breadcrumb">
    <div class="element">AMAS</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>

<div class="card">
    <div class="seccion">
        <table id="listMycases" class="table table-hover">


        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="createPermissionModalLabel">REGISTRAR CASO</h5>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="#" id="frm_create_case">
                <div class="modal-body">
                    <div class="sm-1">
                        <label for="PRMS_name" class="form-label">Fecha Recepción</label>
                        <input id="CASE_date_reception" type="date" name="CASE_date_reception" class="form-control " placeholder="Nombre" required>
                    </div>
                    <div class="sm-1">
                        <label for="PRMS_name" class="form-label">Herramienta</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($apps) => "<option value=\"" . esc($apps->APPS_PK) . "\">" . esc($apps->APPS_name) . "</option>", $apps)) ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Entidad</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($entities) => "<option value=\"" . esc($entities->ENTS_PK) . "\">" . esc($entities->ENTS_PK) ." - ". esc($entities->ENTS_name) . "</option>", $entities)) ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Dependencia</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($dependencies) => "<option value=\"" . esc($dependencies->DPND_PK) . "\">" . esc($dependencies->DPND_PK)." - ". esc($dependencies->DPND_name) . "</option>", $dependencies)) ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Grupo</label>
                        <select class="form-select"  name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($groups) => "<option value=\"" . esc($groups->GRPS_PK) . "\">" . esc($groups->GRPS_name) . "</option>", $groups)) ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Estado</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($statescases) => "<option value=\"" . esc($statescases->STCS_PK) . "\">" . esc($statescases->STCS_name) . "</option>", $statescases)) ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Tipo caso</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($tipescases) => "<option value=\"" . esc($tipescases->TPCS_PK) . "\">" . esc($tipescases->TPCS_name) . "</option>", $tipescases)) ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="PRMS_name" class="form-label">Categoria</label>
                        <select class="form-select" name="habilidad" id="habilidad">
                            <?= implode('', array_map(fn($categoriescase) => "<option value=\"" . esc($categoriescase->CTCS_PK) . "\">" . esc($categoriescase->CTCS_name) . "</option>", $categoriescase)) ?>
                        </select>
                    </div>
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

<script type="text/javascript" src="<?= base_url('assets/scripts/amas/listMyCase.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/scripts/amas/createCases.js'); ?>"></script>
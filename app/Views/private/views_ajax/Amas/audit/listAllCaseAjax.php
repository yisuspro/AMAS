<div class="breadcrumb">
    <div class="element">AMAS</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>

<div class="card">
    <div class="seccion">
        <table id="listAllcases" class="table table-hover" style="width: 100%"></table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createCaseModal" tabindex="-1" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="createPermissionModalLabel">REPORTE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="#" id="frm_create_case">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                        <label for="CASE_date_reception" class="form-label">Fecha Recepción</label>
                            <div class="col-md-6">
                                <input id="CASE_date_reception_1" type="date" name="CASE_date_reception_1" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                            <div class="col-md-6">
                                <input id="CASE_date_reception_2" type="date" name="CASE_date_reception_2" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <label for="CASE_date_solution" class="form-label">Fecha Solucion</label>
                            <div class="col-md-6">
                                <input id="CASE_date_solution_1" type="date" name="CASE_date_solution_1" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                            <div class="col-md-6">
                                <input id="CASE_date_solution_2" type="date" name="CASE_date_solution_2" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                        </div>
                        
                        <div class="row">
                        <div class="col-md-6">
                            <label for="CASE_FK_app" class="form-label">Herramienta</label>
                            <select class="form-select" name="CASE_FK_app" id="CASE_FK_app">
                                <option value="">Seleccione</option>
                            <?= implode('', array_map(fn($apps) => "<option value=\"" . esc($apps->APPS_PK) . "\">" . esc($apps->APPS_name) . "</option>", $apps)) ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                        <label for="CASE_FK_case_categorie" class="form-label">Agente</label>
                            <select class="form-select" name="CASE_FK_case_categorie" id="CASE_FK_case_categorie">
                            <option value="">Seleccione</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="CASE_FK_state_case" class="form-label">Estado</label>
                            <select class="form-select" name="CASE_FK_state_case" id="CASE_FK_state_case">
                            <option value="">Seleccione</option>
                            <?= implode('', array_map(fn($statescases) => "<option value=\"" . esc($statescases->STCS_PK) . "\">" . esc($statescases->STCS_name) . "</option>", $statescases)) ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="CASE_FK_tipe_case" class="form-label">Tipo caso</label>
                            <select class="form-select" name="CASE_FK_tipe_case" id="CASE_FK_tipe_case">
                            <option value="">Seleccione</option>
                            <?= implode('', array_map(fn($tipescases) => "<option value=\"" . esc($tipescases->TPCS_PK) . "\">" . esc($tipescases->TPCS_PK)." - ". esc($tipescases->TPCS_name) . "</option>", $tipescases)) ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Generar reporte</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/amas/audit/listAllCase.js'); ?>"></script>
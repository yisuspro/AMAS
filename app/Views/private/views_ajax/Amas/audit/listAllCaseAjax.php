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
                            <div class="col-md-6">
                                <label for="CASE_date_reception" class="form-label">Fecha Recepción</label>
                                <input id="CASE_date_reception" type="date" name="CASE_date_reception" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="CASE_date_solution" class="form-label">Fecha Solucion</label>
                                <input id="CASE_date_solution" type="date" name="CASE_date_solution" class="form-control " value="<?= date('Y-m-d')?>" max ="<?= date('Y-m-d')?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="CASE_number" class="form-label">No. de caso</label>
                                <input id="CASE_number" type="text" name="CASE_number" class="form-control" placeholder="Numero de caso" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <label for="CASE_FK_app" class="form-label">Herramienta</label>
                            <select class="form-select" name="CASE_FK_app" id="CASE_FK_app">
                                
                            </select>
                        </div>
                        <div class="col-md-6">
                        <label for="CASE_FK_case_categorie" class="form-label">Dificultad</label>
                            <select class="form-select" name="CASE_FK_case_categorie" id="CASE_FK_case_categorie">
                                
                            </select>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        <label for="CASE_FK_entities" class="form-label">Entidad</label>
                            <select class="form-select" name="CASE_FK_entities" id="CASE_FK_entities">
                              
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="CASE_FK_dependence" class="form-label">Dependencia</label>
                            <select class="form-select" name="CASE_FK_dependence" id="CASE_FK_dependence">
                                
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="CASE_FK_state_case" class="form-label">Estado</label>
                            <select class="form-select" name="CASE_FK_state_case" id="CASE_FK_state_case">
                                
                        </div>
                        <div class="col-md-6">
                            <label for="CASE_FK_tipe_case" class="form-label">Tipo caso</label>
                            <select class="form-select" name="CASE_FK_tipe_case" id="CASE_FK_tipe_case">
                                
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                            <label for="form_actions" class="form-label">Accion realizada</label>
                            <textarea name="form_actions" id= "form_actions" placeholder="Insertar  accion" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="form_observations" class="form-label">Observacion</label>
                            <textarea name="form_observations" id= "form_observations" placeholder="Insertar  accion" class="form-control" rows="5"></textarea>
                        </div>
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

<script type="text/javascript" src="<?= base_url('assets/scripts/amas/audit/listAllCase.js'); ?>"></script>
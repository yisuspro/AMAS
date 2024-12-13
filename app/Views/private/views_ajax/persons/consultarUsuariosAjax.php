<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">Consultar Usuarios Aplicaciones</i>
    </div>

    <div class="card-body">
        <form method="post" action="#" id="frm_consult_users">
            <div class="mb-3">
                <label class="form-label">Número de Documento</label>
                <input id="PRSN_document" type="text" name="PRSN_document" class="form-control" placeholder="Número de documento">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">Resultados</i>
    </div>
    
    <div class="seccion">
        <table id="table_users" class="table table-hover" style="width:100%"></table>
    </div>

    <div class="card-footer">
        <button type="cancel" class="btn btn-danger" id="back" name="back">ATRAS</button>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/consultPersons.js'); ?>"></script>

<div class="card form_consult">
    <div class="card-header">
        CONSULTA USUARIOS APLICACIONES
    </div>
    
    <div class="card-body">
        <form method="post" action="#" id="frm_consult_users">
            <div class="mb-3">
                <label class="form-label">Número de Documento</label>
                <input id="PRSN_document" type="text" name="PRSN_document" class="form-control" placeholder="Número de documento">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
</div>

<div class="results">

    <div class="card">
            <div class="card-header">
                DATOS USUARIO
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_name" class="form-label">Nombre completo</label>
                            <div class="input-group">
                                <input id="PRSN_name" type="text" name="PRSN_name" class="form-control" placeholder="Nombre" required>
                                <button type="button" class="btn btn-outline-secondary copy-btn">Copy</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_document" class="form-label">Número documento</label>
                            <div class="input-group">
                                <input id="PRSN_document" type="text" name="PRSN_document" class="form-control" placeholder="Documento" required>
                                <button type="button" class="btn btn-outline-secondary copy-btn">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_email" class="form-label">Correo electrónico</label>
                            <div class="input-group">
                                <input id="PRSN_email" type="email" name="PRSN_email" class="form-control" placeholder="Correo electrónico" required>
                                <button type="button" class="btn btn-outline-secondary copy-btn">Copy</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_phone" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <input id="PRSN_phone" type="text" name="PRSN_phone" class="form-control" placeholder="Teléfono" required>
                                <button type="button" class="btn btn-outline-secondary copy-btn">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_position" class="form-label">Cargo</label>
                            <div class="input-group">
                                <input id="PRSN_position" type="text" name="PRSN_position" class="form-control" placeholder="Cargo" required>
                                <button type="button" class="btn btn-outline-secondary copy-btn">Copy</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        ALERT
                    </div>
                </div>    
            </div>
        </div>


        <div class="card mt-2 datatable" >
            <table id="table_users" class="table table-hover" style="width:100%"></table>
        </div>
    </div>
    
    <style>
        .datatable{
            overflow-x: scroll;
        }
        .results {
            display: none;
        }

        .ui-state-default{
            background-color: #003188 !important;
            font-family: Nunito Sans;
            font-size: 18px;
            font-weight: 800;
            line-height: 24.55px;
            text-align: center;
            text-underline-position: from-font;
            text-decoration-skip-ink: none;
            color: #fff !important;
            padding: 13px;
        }
        .dt-layout-cell {
            padding: 0 !important;
        }
    </style>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/consultPersons.js'); ?>"></script>

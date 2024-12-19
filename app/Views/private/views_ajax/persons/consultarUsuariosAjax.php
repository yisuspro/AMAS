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

    <div class="col">
        <div class="card">
            <div class="card-header">
                DATOS USUARIO
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_name" class="form-label">Nombre completo</label>
                            <div class="d-flex">
                                <input id="PRSN_name" type="text" name="PRSN_name" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_document" class="form-label">Número documento</label>
                            <div class="d-flex">
                                <input id="PRSN_document_1" type="text" name="PRSN_document_1" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_email" class="form-label">Correo electrónico</label>
                            <div class="d-flex">
                                <input id="PRSN_email" type="text" name="PRSN_email" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_phone" class="form-label">Teléfono</label>
                            <div class="d-flex">
                                <input id="PRSN_phone" type="text" name="PRSN_phone" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_position" class="form-label">Cargo</label>
                            <div class="d-flex">
                                <input id="PRSN_position" type="text" name="PRSN_position" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        ALERT
                    </div>
                </div>    
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                DOCUMENTOS
            </div>
            <div class="card-body">
                DOC
            </div>
        </div>
    </div>
    <div class="col">

        <div class="card datatable" >
            <table id="table_users" class="table table-hover" style="width:100%"></table>
        </div>
    </div>
    </div>
    <style>
        .datatable{
            overflow-x: scroll;
        }
        .results {
            display: none;
        }

        .results .card {
            max-width: 90% !important; 
            min-width: 80% !important;
        }
    </style>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/consultPersons.js'); ?>"></script>

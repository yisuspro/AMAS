<div class="breadcrumb">
    <div class="element">Personas</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element">Consulta usuarios</div>
</div>

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
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Consultar</button>
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
                </div>    
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                DOCUMENTOS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Acuerdo de confidencialidad</label>
                            <span class="badge text-bg-primary">Primary</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label">Cédula de ciudadanía</label>
                            <span class="badge text-bg-primary">Primary</span>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card datatable" >
            <table id="table_users" class="table table-hover" style="width:100%"></table>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                AUDITORIA
            </div>
            <div class="datatable">
                <table id="table_cases" class="table table-hover" style="width:100%"></table>
            </div>
        </div>
    </div>
    </div>
    <style>
        .results {
            display: none;
        }

        .results .card {
            max-width: 90% !important; 
            min-width: 80% !important;
        }

        .btn-primary {
            width: 50%;
            margin: 0 auto;
            background-color: #003188;
        }
    </style>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/consultPersons.js'); ?>"></script>

<div class="breadcrumb">
    <div class="element">FUD</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element">Consulta FUD</div>
</div>

<div class="card form_consult">
    <div class="card-header">
        CONSULTA FUD 
    </div>   
    <div class="card-body">
        <form method="post" action="#" id="frm_consult_fud">
            <div class="mb-3">
                <label class="form-label">Número de Formulario
                </label>
                <input id="FUD_number" type="text" name="FUD_number" class="form-control" placeholder="Número de Formulario Único de Declaración">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Consultar</button>
            </div>
        </form>
    </div>
</div>

<div class="results">
    <div class="col">
        <div class="card mt-2">
            <div class="card-header">
                DATOS FUD
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="FUD_NUMBER" class="form-label">Numero FUD</label>
                            <div class="d-flex">
                                <input id="FUD_NUMBER" type="text" name="FUD_NUMBER" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="FUD_ESTADO" class="form-label">Estado Actual</label>
                            <div class="d-flex">
                                <input id="FUD_ESTADO" type="text" name="FUD_ESTADO" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="FUD_DATEREGISTER" class="form-label">Fecha Radicación</label>
                            <div class="d-flex">
                                <input id="FUD_DATEREGISTER" type="text" name="FUD_DATEREGISTER" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="ID_DECLARACION" class="form-label">Declaración</label>
                            <div class="d-flex">
                                <input id="ID_DECLARACION" type="text" name="ID_DECLARACION" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="FUD_DATEDECLARACION" class="form-label">Fecha Declaración</label>
                            <div class="d-flex">
                                <input id="FUD_DATEDECLARACION" type="text" name="FUD_DATEDECLARACION" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="FUD_VALORADOR" class="form-label">USUARIO</label>
                            <div class="d-flex">
                                <input id="FUD_VALORADOR" type="text" name="FUD_VALORADOR" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="FUD_USUARIO" class="form-label">VALORADOR</label>
                            <div class="d-flex">
                                <input id="FUD_USUARIO" type="text" name="FUD_USUARIO" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>


        <div class="card mt-2 sirav-panel" >
            <div class="card-header">
                SIRAV Actos Administrativos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_CodigoDeclaracion" class="form-label">Codigo Declaración</label>
                            <div class="d-flex">
                                <input id="AA_CodigoDeclaracion" type="text" name="AA_CodigoDeclaracion" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_FechaValoracion" class="form-label">Fecha Valoración</label>
                            <div class="d-flex">
                                <input id="AA_FechaValoracion" type="text" name="AA_FechaValoracion" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_OrfeoResolucion" class="form-label">Resolución ORFEO</label>
                            <div class="d-flex">
                                <input id="AA_OrfeoResolucion" type="text" name="AA_OrfeoResolucion" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_Resolucion" class="form-label">Resolución</label>
                            <div class="d-flex">
                                <input id="AA_Resolucion" type="text" name="AA_Resolucion" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_Nombre" class="form-label">Nombre Valorador</label>
                            <div class="d-flex">
                                <input id="AA_Nombre" type="text" name="AA_Nombre" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label for="AA_Estado" class="form-label">Estado</label>
                            <div class="d-flex">
                                <input id="AA_Estado" type="text" name="AA_Estado" class="form-control-plaintext" readonly>
                                <i class="bi bi-copy copy-btn"></i>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <div id="fudAA">
                                <label for="AA_Observaciones" class="form-label">Observaciones</label>
                                <div class="d-flex">
                                    <input id="AA_Observaciones" type="text" name="AA_Observaciones" class="form-control-plaintext" readonly>
                                    <i class="bi bi-copy copy-btn"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mt-2">
            <div class="card-header">
                AUDITORIA CASOS
            </div>
            <div class="datatable">
                <table id="table_cases" class="table table-hover" style="width:100%"></table>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                AUDITORIA RUV
            </div>
            <div class="datatable">
                <table id="table_audit" class="table table-hover" style="width:100%"></table>
            </div>
        </div>
    </div>
    </div>
    <style>
        .sirav-panel {
            display: none;
        }
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

<script type="text/javascript" src="<?= base_url('assets/scripts/fud/consultaFUD.js'); ?>"></script>

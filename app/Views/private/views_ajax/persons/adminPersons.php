<div class="create_person">
    <form method="post" action="#" id="frm_create_person" enctype="multipart/form-data">
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
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_document" class="form-label">Número documento</label>
                            <div class="input-group">
                                <input id="PRSN_document" type="text" name="PRSN_document" class="form-control" placeholder="Documento" required>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="PRSN_phone" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <input id="PRSN_phone" type="text" name="PRSN_phone" class="form-control" placeholder="Teléfono" required>
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
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        ALERT
                    </div>
                </div>    
            </div>
        </div>


        <div class="card">
            <div class="card-header">
                DOCUMENTOS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="DCPR_name_1" class="form-label">Acuerdo de confidencialidad</label>
                            <input id="DCPR_name_1" type="file" name="DCPR_name_1" class="form-control" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="DCPR_name_2" class="form-label">Documento</label>
                            <input id="DCPR_name_2" type="file" name="DCPR_name_2" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="area-buttons">
            <button type="submit" class="btn btn-primary btn-block">Crear usuario</button>
            <button type="button" class="btn btn-danger" id="back" name="back">Atras</button>
        </div>
    </form>
</div>

<style>

.area-buttons{
    margin-top: 30px;
    display: flex;
    justify-content: space-evenly;
}

</style>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/createPerson.js'); ?>"></script>

<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">Crear persona</i>
    </div>
    <div class="seccion">
        <form method="post" action="#" id="frm_create_person" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="PRSN_name" class="form-label">Nombre completo</label>
                <input id="PRSN_name" type="text" name="PRSN_name" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
                <label for="PRSN_document" class="form-label">Numero Documento</label>
                <input id="PRSN_document" type="text" name="PRSN_document" class="form-control" placeholder="Documento" required>
            </div>
            <div class="mb-3">
                <label for="PRSN_email" class="form-label">Correo electronico</label>
                <input id="PRSN_email" type="email" name="PRSN_email" class="form-control" placeholder="Correo electronico" required>
            </div>
            <div class="mb-3">
                <label for="PRSN_phone" class="form-label">Telefono</label>
                <input id="PRSN_phone" type="text" name="PRSN_phone" class="form-control" placeholder="Telefono" required>
            </div>
            <div class="mb-3">
                <label for="PRSN_position" class="form-label">Cargo</label>
                <input id="PRSN_position" type="text" name="PRSN_position" class="form-control" placeholder="Cargo" required>
            </div>
            <div class="mb-3">
                <label for="DCPR_name_1" class="form-label">Acuerdo de confidencialidad</label>
                <input id="DCPR_name_1" type="file" name="DCPR_name_1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="DCPR_name_2" class="form-label">Documento</label>
                <input id="DCPR_name_2" type="file" name="DCPR_name_2" class="form-control" required>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block">CREAR</button>
                <button type="button" class="btn btn-danger" id="back" name="back">ATRAS</button>
            </div>
            </form>
            </div>
            </div>

<script type="text/javascript" src="<?= base_url('assets/scripts/persons/createPerson.js'); ?>"></script>

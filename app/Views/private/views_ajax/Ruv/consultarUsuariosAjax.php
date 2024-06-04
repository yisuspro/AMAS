<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">Consultar Usuarios Aplicaciones</i>
    </div>
    <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Numeroc Documento</label>
                <input id="IDENTIFICACION" type="text" name="IDENTIFICACION" class="form-control" placeholder="numero de documento" >
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input id="NOMBRE" type="text" name="NOMBRE" class="form-control" placeholder="Nombre de usuario" >
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block Consultar">BUSCAR</button>
            </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/consultUsers.js'); ?>"></script>
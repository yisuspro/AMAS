<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">Consultar Usuarios Aplicaciones</i>
    </div>

    <div class="card-body">
        <form method="post" action="#" id="frm_consult_users">
            <div class="mb-3">
                <label class="form-label">Número de Documento</label>
                <input id="IDENTIFICACION" type="text" name="IDENTIFICACION" class="form-control" placeholder="Número de documento">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input id="NOMBRE" type="text" name="NOMBRE" class="form-control" placeholder="Nombre de usuario">
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-block">Buscar</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/consultUsers.js'); ?>"></script>

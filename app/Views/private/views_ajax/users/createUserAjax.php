<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">crear usuario</i>
    </div>
    <div class="seccion">
        <form method="post" action="#" id="frm_create_user">
            <div class="mb-3">
                <label class="form-label">Nombre completo</label>
                <input id="USER_name" type="text" name="USER_name" class="form-control" placeholder="usuario" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Numeroc Documento</label>
                <input id="USER_identification" type="text" name="USER_identification" class="form-control" placeholder="usuario" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="usuario" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña:</label>
                <input id="USER_password" type="password" name="USER_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Repetir Contraseña:</label>
                <input id="USER_password_two" type="password" name="USER_password_two" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">crear</button>
            <button type="cancel" class="btn btn-danger ">cancelar</button>
        </form>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/createUser.js'); ?>"></script>
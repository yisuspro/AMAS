<div class="breadcrumb">
    <div class="element">Usuarios</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element">Crear Usuario</div>
</div>

<form method="post" action="#" id="frm_create_user">
    <div class="card">
        <div class="card-header">
            CREACIÓN USUARIO
        </div>
        <div class="card-body">
            
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_name" class="form-label">Nombre completo</label>
                        <input id="USER_name" type="text" name="USER_name" class="form-control" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_identification" class="form-label">Numero Documento</label>
                        <input id="USER_identification" type="text" name="USER_identification" class="form-control" placeholder="Documento" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_username" class="form-label"><?= lang("General.user") ?></label>
                        <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="<?= lang("General.user") ?>" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_email" class="form-label">Correo electronico</label>
                        <input id="USER_email" type="email" name="USER_email" class="form-control" placeholder="Correo electronico" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_address_ip" class="form-label">Direccion IP</label>
                        <input id="USER_address_ip" type="text" name="USER_address_ip" class="form-control" placeholder="Direccion ip" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_password" class="form-label">Contraseña</label>
                        <input id="USER_password" type="password" name="USER_password" class="form-control" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="USER_password_two" class="form-label">Repetir Contraseña</label>
                        <input id="USER_password_two" type="password" name="USER_password_two" class="form-control" required>
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

<script type="text/javascript" src="<?= base_url('assets/scripts/users/createUser.js'); ?>"></script>

<div class="breadcrumb">
    <div class="element">Usuarios</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element">Actualizar usuario</div>
</div>
<form method="post" action="#" id="frm_update_user">
    <div class="card">
        <div class="card-header">
            ACTUALIZACIÓN USUARIO
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <div class="mb-3">
                        <label class="form-label">Id usuario</label>
                        <input id="USER_PK" type="text" name="USER_PK" class="form-control" placeholder="<?= lang("General.user") ?>" value="<?= $data->USER_PK ?? 0 ?>" readonly>
                    </div>
                </div>
                <div class="col-4">
                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updatePasswordUsers"><i class="bi bi-arrow-clockwise">CAMBIAR CONTRASEÑA</i></a>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input id="USER_name" type="text" name="USER_name" class="form-control" placeholder="Nombre" value="<?= $data->USER_name ?? 0 ?>" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Numero Documento</label>
                        <input id="USER_identification" type="text" name="USER_identification" class="form-control" placeholder="identificacion" value="<?= $data->USER_identification ?? 0 ?>" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label"><?= lang("General.user") ?></label>
                        <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="Nombre de usuario" value="<?= $data->USER_username ?? 0 ?>" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Correo electronico</label>
                        <input id="USER_email" type="text" name="USER_email" class="form-control" placeholder="correo electronico" value="<?= $data->USER_email ?? 0 ?>" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label class="form-label">Direccion IP</label>
                        <input id="USER_address_ip" type="text" name="USER_address_ip" class="form-control" placeholder="direccion IP" value="<?= $data->USER_address_ip ?? 0 ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="area-buttons">
            <button type="submit" class="btn btn-primary btn-block">Modificar usuario</button>
            <button type="button" class="btn btn-danger" id="back" name="back">Atras</button>
        </div>
</form>

<!-- Modal -->
<div class="modal fade" id="updatePasswordUsers" tabindex="-1" aria-labelledby="updatePasswordUsers" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasswordUsers">CAMBIO DE CONTRASEÑA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="#" id="frm_update_password_users">
                <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Id usuario</label>
                            <input id="USER_PK_P" type="hidden" name="USER_PK_P" class="form-control" placeholder="Id <?= lang("General.user") ?>" value="<?= $data->USER_PK ?? 0 ?>" readonly>
                        </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <input id="USER_password_P" type="password" name="USER_password_P" class="form-control" placeholder="Nueva contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Repetir Contraseña</label>
                        <input id="USER_password_two_P" type="password" name="USER_password_two_P" class="form-control" placeholder="Repetir contraseña" required>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">Cambiar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/updateUsers.js'); ?>"></script>
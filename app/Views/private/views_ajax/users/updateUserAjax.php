<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">crear usuario</i>
    </div>
    <div class="seccion ">

        <form method="post" action="#" id="frm_update_user">
            <?php foreach ($data as $dataUser) : ?>

                <div class="mb-3 row">
                    <div class="col col-sm-8">
                        <label class="form-label">Id usuario</label>
                        <input id="USER_PK" type="text" name="USER_PK" class="form-control" placeholder="usuario" value="<?= $dataUser['USER_PK'] ?? 0 ?>" readonly>
                    </div>
                    <div class="col">
                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updatePasswordUsers"><i class="bi bi-arrow-clockwise">CAMBIAR CONTRASEÑA</i></a>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nombre completo</label>
                    <input id="USER_name" type="text" name="USER_name" class="form-control" placeholder="usuario" value="<?= $dataUser['USER_name'] ?? 0 ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Numeroc Documento</label>
                    <input id="USER_identification" type="text" name="USER_identification" class="form-control" placeholder="identificacion" value="<?= $dataUser['USER_identification'] ?? 0 ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="Nombre de usuario" value="<?= $dataUser['USER_username'] ?? 0 ?>" required>
                </div>


            <?php endforeach; ?>

            <button type="submit" class="btn btn-success btn-block">Actualizar</button>
            <button type="cancel" class="btn btn-danger ">cancelar</button>
        </form>
    </div>
</div>

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
                    <?php foreach ($data as $dataUser) : ?>

                        <div class="mb-3">
                            <label class="form-label">Id usuario</label>
                            <input id="USER_PK_P" type="text" name="USER_PK_P" class="form-control" placeholder="usuario" value="<?= $dataUser['USER_PK'] ?? 0 ?>" readonly>
                        </div>
                    <?php endforeach; ?>
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
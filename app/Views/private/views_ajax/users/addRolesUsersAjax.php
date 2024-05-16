<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title . $id ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">

        <input id="idUser" name="idUser" type="hidden" value="<?= $id ?? 0 ?>">


        <table id="listUsersRoles" class="table table-hover" style="width:100% ">
            <thead>
                <th>
                    ID ROL
                </th>
                <th>
                    NOMBRE
                </th>
                <th>
                    DESCRIPCION
                </th>
                <th>
                    ESTADO
                </th>
            </thead>
            <tfoot>
                <th>
                    ID ROL
                </th>
                <th>
                    NOMBRE
                </th>
                <th>
                    DESCRIPCION
                </th>
                <th>
                    ESTADO
                </th>
            </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/listUsersRoles.js'); ?>"></script>
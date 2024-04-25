<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title.$id ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">
        aca van los permisos

        <input id="idRol" name="idRol" type="hidden" value="<?= $id ?? 0 ?>" >
        

        <table id="listRolesPermissions" class="table table-hover" style="width:100% ">
            <thead>
                <th>
                    ID PERMISO
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
                    ID PERMISO
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

<script type="text/javascript" src="<?= base_url('assets/scripts/roles/listRolesPermissions.js'); ?>"></script>

<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text">Consulta Permisos</i>
    </div>
    <div class="seccion">

        <table id="sample_1" class="table table-hover" style="width:100% ">
            <thead>
                <th>
                    ID PERMISOS
                </th>
                <th>
                    NOMBRE
                </th>
                <th>
                    DESCRIPCION
                </th>
                <th>
                    NOMBRE CORTO
                </th>
                <th>
                    FECHA DE CREACION
                </th>
                <th>
                    FECHA DE MODIFICACION
                </th>

                <th>
                    ACCIONES
                </th>
            </thead>
            <tfoot>
                <th>
                    ID PERMISOS
                </th>
                <th>
                    NOMBRE
                </th>
                <th>
                    DESCRIPCION
                </th>
                <th>
                    NOMBRE CORTO
                </th>
                <th>
                    FECHA DE CREACION
                </th>
                <th>
                    FECHA DE MODIFICACION
                </th>

                <th>
                    ACCIONES
                </th>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createPermissionModal" tabindex="-1" aria-labelledby="createPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPermissionModalLabel">CREAR PERMISO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="#" id="frm_create_user">
                    <div class="mb-3">
                        <label class="form-label">Nombre permiso</label>
                        <input id="USER_name" type="text" name="USER_name" class="form-control" placeholder="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <input id="USER_identification" type="text" name="USER_identification" class="form-control" placeholder="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre corto</label>
                        <input id="USER_username" type="text" name="USER_username" class="form-control" placeholder="usuario" required>
                    </div>
                    
                   
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-block">crear</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/Permissions/listPermissions.js'); ?>"></script>
<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-journal-text"><?= $title . $id ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="card-body">
        <input id="idUser" name="idUser" type="hidden" value="<?= $id ?? 0 ?>">

        <table id="listUsersRoles" class="table table-hover" style="width:100% ">
            <thead>
                <th>ID ROL</th>
                <th>NOMBRE</th>
                <th><?= strtoupper(lang("General.description")) ?></th>
                <th>ESTADO</th>
            </thead>
            <tfoot>
                <th>ID ROL</th>
                <th>NOMBRE</th>
                <th><?= strtoupper(lang("General.description")) ?></th>
                <th>ESTADO</th>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <button type="cancel" class="btn btn-danger" id="back" name="back">ATRAS</button>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/users/listUsersRoles.js'); ?>"></script>
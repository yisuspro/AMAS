<div class="breadcrumb">
    <div class="element">Roles</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title . $id ?? 'Mi Aplicación' ?></div>
</div>

<div class="card">
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
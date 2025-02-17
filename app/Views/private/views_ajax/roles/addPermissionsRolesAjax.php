<div class="breadcrumb">
    <div class="element">Roles</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title . $role->ROLE_name ?? 'Mi Aplicación' ?></div>
</div>

<div class="card">
    <div class="card-body">
        <input id="idRol" name="idRol" type="hidden" value="<?= $role->ROLE_PK ?? 0 ?>">
        <table id="listRolesPermissions" class="table table-hover" style="width:100%"></table>
    </div>
    <div class="modal-footer">
        <button type="cancel" class="btn btn-danger" id="back" name="back">ATRAS</button>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/roles/listRolesPermissions.js'); ?>"></script>
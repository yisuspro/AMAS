<div class="breadcrumb">
    <div class="element">AMAS</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>

<div class="card">
    <div class="seccion">
        <table id="listAllcases" class="table table-hover" style="width: 100%"></table>
    </div>
</div>



<script type="text/javascript" src="<?= base_url('assets/scripts/amas/listAllCase.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/scripts/amas/createCases.js'); ?>"></script>
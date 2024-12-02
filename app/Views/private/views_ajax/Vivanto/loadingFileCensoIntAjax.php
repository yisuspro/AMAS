<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person"><?= $title ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">
        <form method="post" action="#" id="frm_loading_censo" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Censo a cargar</label>
                <input id="file" type="file" name="file" class="form-control" >
            </div>
            
            <div class="card-footer">
                <input type="button" value="Upload" id="loadingBtn">
                <button type="cancel" class="btn btn-danger" id="back" name="back">ATRAS</button>
            </div>
        </form>
    </div>

    <div id="dataContainer">
        <!-- Aquí se mostrará la tabla de datos -->
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/Vivanto/loadingFileCensoInt.js'); ?>"></script>
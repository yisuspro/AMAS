<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person"><?= $title ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">
        <form method="post" action="#" id="frm_loading_censo" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">Censo a cargar</label>
                <input id="file" type="file" name="file" class="form-control" required>
            </div>
            
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="loadingBtn">Subir</button>
                <button type="button" class="btn btn-danger" id="back" name="back">ATRAS</button>
            </div>
        </form>
    </div>

    <div id="dataContainer">
        <!-- Aquí se mostrará la tabla de datos cargados -->
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/scripts/Vivanto/loadingFileCensoUbica.js'); ?>"></script>

<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person"><?= $title ?? 'Mi Aplicación' ?></i>
    </div>
    <div class="seccion">
        <!-- Display RUV Table -->
        <?php if ($aplicaciones['Ruv']) : ?>
            <input type="hidden" value="<?= $tipo ?? '0' ?>" id="TIPO">
            <input type="hidden" value="<?= $parametro ?? '0' ?>" id="PARAMETRO">
            <h2>RUV</h2>
            <table id="table_ruv" class="table table-hover" style="width:100%">
                <thead>
                    <th></th>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>IDENTIFICACION</th>
                    <th>USUARIO</th>
                    <th>CORREO</th>
                    <th>ESTADO</th>
                    <th>ROLES</th>
                    <th>CARGO</th>
                </thead>
            </table>
            <script type="text/javascript" src="<?= base_url('assets/scripts/Ruv/listUsers.js'); ?>"></script>
        <?php endif; ?>

        <!-- Display SIRAV Table -->
        <?php if ($aplicaciones['Sirav']) : ?>
            <h2>SIRAV</h2>
            <table id="table_sirav" class="table table-hover" style="width:100%">
                <thead>
                    <th></th>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>IDENTIFICACION</th>
                    <th>USUARIO</th>
                    <th>CORREO</th>
                    <th>FIRMA</th>
                    <th>ESTADO</th>
                    <th>ROLES</th>
                    <th>CARGO</th>
                </thead>
            </table>
            <script type="text/javascript" src="<?= base_url('assets/scripts/Sirav/listUsers.js'); ?>"></script>
        <?php endif; ?>

        <!-- Display SIPOD Table -->
        <?php if ($aplicaciones['Sipod']) : ?>
            <h2>SIPOD</h2>
            <table id="table_sipod" class="table table-hover" style="width:100%">
                <thead>
                    <th></th>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>IDENTIFICACION</th>
                    <th>USUARIO</th>
                    <th>CORREO</th>
                    <th>ESTADO</th>
                    <th>ROLES</th>
                    <th>CARGO</th>
                </thead>
            </table>
            <script type="text/javascript" src="<?= base_url('assets/scripts/Sipod/listUsers.js'); ?>"></script>
        <?php endif; ?>
    </div>
    
    <!-- Back Button -->
    <div class="card-footer">
        <button type="cancel" class="btn btn-danger" id="back" name="back">ATRAS</button>
    </div>
</div>

<!-- Buttons Script -->
<script type="text/javascript" src="<?= base_url('assets/scripts/Ruv/buttons.js'); ?>"></script>

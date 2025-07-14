<div class="breadcrumb">
    <div class="element">RUV</div>
    <div class="element"><i class="bi bi-chevron-right"></i></div>
    <div class="element"><?= $title ?? 'Mi Aplicación' ?></div>
</div>
<div>
    <div class="card form_consult">
        <div class="card-header">
            <?=  $title ?>
        </div>   
        <div class="card-body">
            <form method="post" action="#" id="frm_consult_fud_entities">
                <div class="mb-3">
                    <label class="form-label">Número de declaración</label>
                    <input id="numeroformulario" type="text" name="numeroformulario" class="form-control" placeholder="Número de declaración">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>Buscar</button>
                </div>
            </form>

            <form method="post" action="#" id="frm_set_entity" class="mt-4">
                <div class="mb-3" id="contenedor-entidades">
                </div>  
                <div class="mb-3">
                    <label class="form-label">Razón de cambio</label>
                    <textarea id="observations" type="text" name="observations" class="form-control" placeholder="Razón de cambio"  class="form-control" rows="3" required></textarea>
                </div>  
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i>Actualizar</button>
                </div>
            
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="<?= base_url('assets/scripts/Ruv/changeEntities.js'); ?>"></script>
    <style>
        #frm_set_entity {
            display: none;
        }
    </style>
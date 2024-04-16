<?= $this->extend('private/tools/base') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="titulo-uno">
        <i class="bi bi-file-earmark-person">perfil</i>
    </div>
    <div class="seccion">
        <div class="row">
            <div class="col-lg-4">
                <div class="col-lg-14">
                    <div class="card-user">
                        <div class="card-image">
                            <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="author">
                                <a href="#">
                                    <h5 class="title"><?= session()->get('USER_name') ?></h5>
                                </a>
                                <p class="description">
                                <?= session()->get('USER_name') ?>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Perfil de <?= session()->get('USER_name') ?></h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" value="<?= session()->get('USER_username') ?>" disabled>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="">
                                        <label>Nombres</label>
                                        <input type="text" class="form-control" placeholder="Company" value="<?= session()->get('USER_name') ?>" disabled>
                                    </div>
                                </div>
                                
                            </div>
                            

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->extend('private/tools/base') ?>

<?= $this->section('content') ?>
<h1>Bienvenido, <?= session()->get('USER_name') ?></h1>

                <i class="bi-alarm" style="font-size: 2rem; color: cornflowerblue;"></i>
          
<?= $this->endSection() ?>
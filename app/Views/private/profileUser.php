
<?= $this->extend('private/tools/base') ?>

<?= $this->section('content') ?>
<h1>Bienvenido, <?= session()->get('USER_name') ?></h1>
<?= $this->endSection() ?>
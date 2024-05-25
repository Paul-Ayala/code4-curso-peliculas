<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Vista de categoria
<?= $this->endSection() ?>
    <?= $this->section('contenido') ?>
    <h1><?= $categoria->titulo ?></h1>
    <?= $this->endSection() ?>
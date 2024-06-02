<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Vista Etiqueta
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<h1><?= $etiqueta->titulo ?></h1>
<?= $this->endSection() ?>
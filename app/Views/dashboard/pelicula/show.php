<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Vista Pelicula
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<h1><?= $pelicula['titulo'] ?></h1>
    <p><?= $pelicula['descripcion'] ?></p>
<?= $this->endSection() ?>
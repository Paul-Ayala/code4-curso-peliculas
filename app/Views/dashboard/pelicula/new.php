<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Crear Pelicula
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<form action="/dashboard/pelicula/create" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Crear']) ?>
    </form>
<?= $this->endSection() ?>
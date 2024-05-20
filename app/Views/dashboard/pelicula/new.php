<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Crear Pelicula
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<?= view('/partials/_form-error') ?>
<form action="/dashboard/pelicula/create" method="post">
        <?= view('dashboard/pelicula/_form', ['op' => 'Crear']) ?>
    </form>
<?= $this->endSection() ?>
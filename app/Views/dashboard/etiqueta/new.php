<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Crear Etiqueta
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<?= view('/partials/_form-error') ?>
<form action="/dashboard/etiqueta/create" method="post">
        <?= view('dashboard/etiqueta/_form', ['op' => 'Crear']) ?>
    </form>
<?= $this->endSection() ?>
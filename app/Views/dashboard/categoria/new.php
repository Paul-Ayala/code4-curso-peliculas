<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Creación de categoria
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<form action="/dashboard/categoria/create" method="post">
        <?= view('dashboard/categoria/_form', ['op' => 'Crear']) ?>
</form>
<?= $this->endSection() ?>

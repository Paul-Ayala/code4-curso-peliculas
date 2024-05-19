<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Edición de categoria
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
    <form action="/dashboard/categoria/update/<?= $categoria['id'] ?>" method="post">
        <?= view('dashboard/categoria/_form', ['op' => 'Actualizar']) ?>
    </form>
<?= $this->endSection() ?>
<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Listado de Categorias
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>

<a href="/dashboard/categoria/new"  class="btn btn-outline-primary btn-lg mb-4">Crear</a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Opciones</th>
    </tr>
<?php foreach ($categorias as $key => $value) : ?>
    <tr>
    <td><?= $value->id ?></td>
    <td><?= $value->titulo ?></td>
    <td>
    <a href="/dashboard/categoria/edit/<?= $value->id ?>"  class="btn btn-outline-success btn-sm mt-1">Editar</a>
    <a href="/dashboard/categoria/show/<?= $value->id ?>" class="btn btn-outline-secondary btn-sm mt-1">Ver</a>
    <form action="/dashboard/categoria/delete/<?= $value->id ?>" method="post">
    <button type="submit" class="btn btn-outline-danger btn-sm mt-1">Eliminar</button>
    </form>
    </td>

</tr>
<?php endforeach ?>
</table>
<?= $pager ->links() ?>
<?= $this->endSection() ?>
<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Listado de Etiquetas
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
    <!-- <a href="<?= route_to('test') ?>">Test</a> -->
    <a href="/dashboard/etiqueta/new" class="btn btn-outline-primary btn-lg mb-4">Crear</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Titulo</th>
            <th>Opciones</th>
        </tr>
    <?php foreach ($etiquetas as $key => $value) : ?>
        <tr>
        <td><?= $value->id ?></td>
        <td><?= $value->categoria ?></td>
        <td><?= $value->titulo ?></td>
        <td>
        <a href="/dashboard/etiqueta/edit/<?= $value->id ?>" class="btn btn-outline-success btn-sm mt-1">Editar</a>
        <a href="/dashboard/etiqueta/show/<?= $value->id ?>" class="btn btn-outline-secondary btn-sm mt-1">Ver</a>
        <a href="<?= route_to('etiqueta.etiquetas', $value->id) ?>" class="btn btn-outline-info btn-sm mt-1">Etiquetas</a>
        <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
        <button type="submit" class="btn btn-outline-danger btn-sm mt-1">Eliminar</button>
        </form>
        </td>

    </tr>
    <?php endforeach ?>
    </table>
    <?= $pager ->links() ?>
<?= $this->endSection() ?>






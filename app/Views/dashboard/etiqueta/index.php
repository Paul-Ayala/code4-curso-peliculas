<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Listado de Etiquetas
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
    <!-- <a href="<?= route_to('test') ?>">Test</a> -->
    <a href="/dashboard/etiqueta/new">Crear</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Categoría</th>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    <?php foreach ($etiquetas as $key => $value) : ?>
        <tr>
        <td><?= $value->id ?></td>
        <td><?= $value->categoria ?></td>
        <td><?= $value->titulo ?></td>
        <td>
        <a href="/dashboard/etiqueta/edit/<?= $value->id ?>">Editar</a>
        <a href="/dashboard/etiqueta/show/<?= $value->id ?>">Ver</a>
        <a href="<?= route_to('etiqueta.etiquetas', $value->id) ?>">Etiquetas</a>
        <form action="/dashboard/etiqueta/delete/<?= $value->id ?>" method="post">
        <button type="submit">Eliminar</button>
        </form>
        </td>

    </tr>
    <?php endforeach ?>
    </table>
    <?= $pager ->links() ?>
<?= $this->endSection() ?>






<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Listado de Peliculas
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
    <a href="<?= route_to('test') ?>">Test</a>
    <a href="/dashboard/pelicula/new">Crear</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    <?php foreach ($peliculas as $key => $value) : ?>
        <tr>
        <td><?= $value['id'] ?></td>
        <td><?= $value['titulo'] ?></td>
        <td><?= $value['descripcion'] ?></td>
        <td>
        <a href="/dashboard/pelicula/edit/<?= $value['id'] ?>">Editar</a>
        <a href="/dashboard/pelicula/show/<?= $value['id'] ?>">Ver</a>
        <form action="/dashboard/pelicula/delete/<?= $value['id'] ?>" method="post">
        <button type="submit">Eliminar</button>
        </form>
        </td>

    </tr>
    <?php endforeach ?>
    </table>
<?= $this->endSection() ?>






<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1>Listado de Categorias</h1>

    <a href="/categoria/new">Crear</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Descripción</th>
            <th>Opciones</th>
        </tr>
    <?php foreach ($categorias as $key => $value) : ?>
        <tr>
        <td><?= $value['id'] ?></td>
        <td><?= $value['titulo'] ?></td>
        <td>
        <a href="/categoria/edit/<?= $value['id'] ?>">Editar</a>
        <a href="categoria/show/<?= $value['id'] ?>">Ver</a>
        <form action="/categoria/delete/<?= $value['id'] ?>" method="post">
        <button type="submit">Eliminar</button>
        </form>
        </td>

    </tr>
    <?php endforeach ?>
    </table>
</body>
</html>
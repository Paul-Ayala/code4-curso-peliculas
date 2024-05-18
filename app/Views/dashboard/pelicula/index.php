<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h1>Listado de Peliculas</h1>
    <!-- si ponem os slash antes "/pelicula/new", el link lo interpretará
     con la url: http://localhost/pelicula/new, si lo accedes desde 
     http://localhost/codeigniter4/public/pelicula/new sí se verá.
     si lo quitas lo agrega y los botones redirigen, pero es más recomendado ponerle slash ya que desde:
 
      http://codeigniter4.test/pelicula/new sigue funcionando:  -->
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
</body>
</html>
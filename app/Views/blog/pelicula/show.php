<?= $this->extend('Layouts/blog') ?>
<?= $this->section('contenido') ?>
<div class="card">
<div class="card-body">
<h1><?= $pelicula->titulo ?></h1>
<hr>
<h3>Categoria:</h3>
<a class="btn btn-primary" href="<?= route_to('blog.pelicula.index_por_categoria', $pelicula->categoria_fk)?>"><?= $pelicula->categoria ?></a>
<h3>Imagenes:</h3>
<div class="d-flex gap-2">
<?php foreach ($imagenes as $i) : ?>
            <img src="/uploads/peliculas/<?= $i->imagen ?>" class="w-25">
<?php endforeach ?>
</div>
<h3>Etiquetas:</h3>
<?php foreach ($etiquetas as $e) : ?>
    <a target="_blank" class="btn btn-sm btn-warning" href="<?= route_to('blog.pelicula.index_por_etiqueta', $e->id)?>"><?= $e->titulo ?></a>      
<?php endforeach ?>
<h3>Descripción:</h3>
<p><?= $pelicula->descripcion ?></p>
</div>
</div>
<?= $this->endSection() ?>
<?php foreach($peliculas as $p) : ?>
    <div class="card mb-3">
        <div class="card-body">
            <h4><?=$p->id?>-) <?=$p->titulo ?></h4>
            <img src="/uploads/peliculas/<?= $p->imagen ?>" class="w-25"><br/><br/><br/>
            <a class="btn btn-sm btn-secondary" href="<?= route_to('blog.pelicula.index_por_categoria', $p->categoria_fk)?>"><?= $p->categoria ?></a>
            <p><?= $p->descripcion ?></p>
            <span href=""><?= $p->etiqueta ?></span><br/>
            <!-- <a href="/blog/<?= $p->id ?>"  class="btn btn-outline-primary">Ver más...</a> -->
            <a href="<?= route_to('blog.pelicula.show', $p->id)?>"  class="btn btn-outline-primary mt-3">Ver más...</a>
           
        </div>
    </div>
<?php endforeach; ?>
<?= $pager->links() ?>
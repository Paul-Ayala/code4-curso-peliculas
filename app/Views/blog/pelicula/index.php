<?= $this->extend('Layouts/blog') ?>
<?= $this->section('contenido') ?>
<h1>Peliculas</h1>
<hr>
<div class="card my-3 text-bg-light border-success mb-3">
<div class="card-body">
<form action="" method="get">
    <div  class="d-flex gap-2">
        <select class="form-control flex-grow-1 categoria_fk" name="categoria_fk" id="categoria_fk">
                <option value="">Seleccionar</option>
                <?php foreach ($categorias as $c) : ?>
                    <option <?= $c->id !== $categoria_fk?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
                <?php endforeach; ?>
        </select>
        <select class="form-control etiqueta_fk" name="etiqueta_fk" id="etiqueta_fk">
        <option value="">Seleccionar</option>
                <?php foreach ($etiquetas as $e) : ?>
                    <option <?= $e->id !== $etiqueta_fk?: 'selected' ?> value="<?= $e->id ?>"><?= $e->titulo ?></option>
                <?php endforeach; ?>
        </select>
    </div>
    <div  class="d-flex gap-2 mt-2">
    <input placeholder="Buscar..." class="form-control" type="text" name="buscar" id="buscar" value="<?=$buscar ?>">
    <input class="btn btn-outline-success" type="submit" value="Enviar">
    <a style="width: 15%;" class="btn btn-outline-secondary" href="<?= route_to('blog.pelicula.index')?>">Limpiar filtros</a>
    </div>
</form>
</div>
</div>
<?= view('/partials/_peliculas') ?>
<script>
    document.querySelector(".categoria_fk").addEventListener('change',()=>{
        fetch('/blog/etiquetas_por_categoria/' + document.querySelector(".categoria_fk").value)
        .then(res => res.json())
        .then(res => {
            var etiquetas = '<option value="">Seleccionar</option>';
            res.forEach((e) => {
                etiquetas += `
            <option value="${e.id}">${e.titulo}</option>
            `
            });
            document.querySelector('.etiqueta_fk').innerHTML = etiquetas
        })
    })
</script>
<?= $this->endSection() ?>
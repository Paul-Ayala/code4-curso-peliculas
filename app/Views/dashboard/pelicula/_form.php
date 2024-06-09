<div class="mb-3">
<label class="form-label" for="titulo">Título:</label>
<input class="form-control" type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $pelicula->titulo) ?>">
</div>
<div class="mb-3">
<label class="form-label" for="descripcion">Descripción:</label>
<textarea class="form-control" name="descripcion" id="descripcion"><?= old('descripcion', $pelicula->descripcion) ?></textarea>
</div>
<div class="mb-3">
<label class="form-label" for="categoria_fk">Categoría:</label>
<select class="form-control" name="categoria_fk" id="categoria_fk">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id !== old('categoria_fk', $pelicula->categoria_fk) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>
</div>
<div class="mb-3">
<?php if ($pelicula->id) : ?>
<label class="form-label" for="imagen">Imagen:</label>
<input class="form-control" type="file" name="imagen" id="imagen">
<?php endif ?>
</div>
<button type="submit" class="btn btn-outline-primary btn-lg mt-4"><?= $op ?></button>

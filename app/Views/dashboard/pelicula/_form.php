<!-- Esto podría ir tanto en edit como en new, como coinciden en este fragmento se reutiliza -->
<label for="titulo">Título:</label>
<input type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $pelicula->titulo) ?>">
<label for="descripcion">Descripción:</label>
<textarea name="descripcion" id="descripcion"><?= old('descripcion', $pelicula->descripcion) ?></textarea>
<label for="categoria_fk">Categoría:</label>
<select name="categoria_fk" id="categoria_fk">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id !== old('categoria_fk', $pelicula->categoria_fk) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>
<?php if ($pelicula->id) : ?>
<label for="imagen">Imagen:</label>
<input type="file" name="imagen" id="imagen">
<?php endif ?>
<button type="submit"><?= $op ?></button>
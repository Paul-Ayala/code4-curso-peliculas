<!-- Esto podría ir tanto en edit como en new, como coinciden en este fragmento se reutiliza -->
<label for="titulo">Título:</label>
<input type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>">
<label for="categoria_fk">Categoría:</label>
<select name="categoria_fk" id="categoria_fk">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id !== old('categoria_fk', $etiqueta->categoria_fk) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>
<button type="submit"><?= $op ?></button>
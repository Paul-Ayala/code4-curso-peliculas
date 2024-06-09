<div class="mb-3">
<label class="form-label" for="titulo">Título:</label>
<input  class="form-control" type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $etiqueta->titulo) ?>">
</div>
<div class="mb-3">
<label class="form-label" for="categoria_fk">Categoría:</label>
<select  class="form-control" name="categoria_fk" id="categoria_fk">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id !== old('categoria_fk', $etiqueta->categoria_fk) ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>
</div>
<button type="submit" class="btn btn-outline-primary btn-lg mt-4"><?= $op ?></button>
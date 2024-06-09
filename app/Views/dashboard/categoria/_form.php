<div class="mb-3">
<label class="form-label" for="titulo">Título:</label>
<input class="form-control" type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= old('titulo', $categoria->titulo) ?>">
</div>
<button type="submit" class="btn btn-outline-primary btn-lg mt-4"><?= $op ?></button>
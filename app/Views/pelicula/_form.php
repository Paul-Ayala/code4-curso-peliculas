<!-- Esto podría ir tanto en edit como en new, como coinciden en este fragmento se reutiliza -->
<label for="titulo">Título:</label>
<input type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?= $pelicula['titulo'] ?>">
<label for="descripcion">Descripción:</label>
<textarea name="descripcion" id="descripcion"><?= $pelicula['descripcion'] ?></textarea>
<button type="submit"><?= $op ?></button>
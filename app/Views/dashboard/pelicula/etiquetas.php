<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Etiquetas
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<form action="" method="post">
<div class="mb-3">
<label class="form-label" for="categoria_fk">Categoría:</label>
<select class="form-control" name="categoria_fk" id="categoria_fk">
    <option value=""></option>
    <?php foreach ($categorias as $c): ?>
        <option <?= $c->id != $categoria_fk ?: 'selected' ?> value="<?= $c->id ?>"><?= $c->titulo ?></option>
        <?php endforeach ?>
</select>
</div>
<div class="mb-3">
<label class="form-label" for="etiqueta_fk">Etiqueta:</label>
<select class="form-control" name="etiqueta_fk" id="etiqueta_fk">
    <option value=""></option>
    <?php foreach ($etiquetas as $e): ?>
        <option value="<?= $e->id ?>"><?= $e->titulo ?></option>
        <?php endforeach ?>
</select>
</div>
<button type="submit"  class="btn btn-outline-primary btn-lg mt-4" id="etiquetasEnviar">Enviar</button>
</form>

<script>
    function disableButtom() {
        if ( document.querySelector('[name=etiqueta_fk]').value == '') {
            document.querySelector("#etiquetasEnviar").setAttribute('disabled', 'disabled')
        }else{
            document.querySelector("#etiquetasEnviar").removeAttribute('disabled', 'disabled')
        }
    }

    document.querySelector('[name=categoria_fk]').onchange = function(){
        window.location.href = '<?= route_to('pelicula.etiquetas', $peliculas->id) ?>?categoria_fk=' + this.value
    }

    document.querySelector('[name=etiqueta_fk]').onchange = function(){
        disableButtom()
    }
    disableButtom()
</script>
<?= $this->endSection() ?>

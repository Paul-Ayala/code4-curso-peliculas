<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('header') ?>
Vista Pelicula
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<h1><?= $pelicula->titulo ?></h1>
    <p><?= $pelicula->descripcion ?></p>


    <h3>Imagenes:</h3>

    <ul>
    <?php foreach ($imagenes as $i) : ?>
            <li>
                <?= $i->imagen ?>
            </li>
    <?php endforeach ?>
    </ul>

    <h3>Etiquetas:</h3>
    <?php foreach ($etiquetas as $e) : ?>
                <button data-url='<?= route_to('pelicula.etiqueta_delete', $pelicula->id, $e->id) ?>' class="delete_etiqueta"><?= $e->titulo ?></button>
    <?php endforeach ?>

    <script>
        document.querySelectorAll('.delete_etiqueta').forEach((b) => {
            b.onclick = function(event) {
                //console.log('click')
                fetch(this.getAttribute('data-url'), {
                    method: 'POST'
                }).then(res => res.json())
                .then(res => {
                    window.location.reload()
                    console.log(res)
                })
            }
        })
    </script>





<?= $this->endSection() ?>
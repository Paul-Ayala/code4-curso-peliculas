<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo web</title>
    <link rel="stylesheet" href="<?=  base_url() ?>bootstrap/css/bootstrap.min.css">

</head>
<body>


    <nav class="navbar navbar-expand-lg mb-3 bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-secondary">CODEIGNITER4</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= base_url()?>dashboard/pelicula" class="nav-link text-light">PELICULAS</a>
                </li>
                <li class="nav-item">
                    <a  href="<?= base_url()?>dashboard/categoria" class="nav-link text-light">CATEGORIAS</a>
                </li>
                <li class="nav-item">
                    <a  href="<?= base_url()?>dashboard/etiqueta" class="nav-link text-light">ETIQUETAS</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <?= view('partials/_session') ?>
    <h1><?= $this->renderSection('header') ?></h1>

    <div class="container">
    <?= $this->renderSection('contenido') ?>
    </div>
    <script src="<?=  base_url() ?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
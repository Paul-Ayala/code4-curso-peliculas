<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo web</title>
    <link rel="stylesheet" href="<?=  base_url() ?>bootstrap/css/bootstrap.min.css">

</head>
<body>
    <?= view('partials/_session') ?>
    <h1><?= $this->renderSection('header') ?></h1>

    <?= $this->renderSection('contenido') ?>
    <script src="<?=  base_url() ?>bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
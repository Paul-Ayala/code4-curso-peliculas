<?= $this->extend('Layouts/web') ?>
<?= $this->section('header') ?>
Registro de usuario
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
<div class="container mt-5">
    <div class="card mx-auto d-block mt-5" style="max-width: 500px;">
    <div class="card-header">
            <h1 class="text-center text-primary"><?= $this->renderSection('header') ?></h1>
            </div>
        <div class="card-body">


<form action="<?= route_to('usuario.register_post') ?>" method="post">
<div class="mb-3">
<label class="form-label" for="usuario">Nombre del usuario:</label>
<input  class="form-control" type="text" name="usuario" id="usuario">
<div class="mb-3">
</div>
<label class="form-label" for="email">Email del usuario:</label>
<input  class="form-control" type="text" name="email" id="email">
<div class="mb-3">
</div>
<label class="form-label" for="contrasena">Contraseña del usuario:</label>
<input  class="form-control" type="password" name="contrasena" id="contrasena">
<div class="mb-3">
</div>
<div class="d-grid gap-2">
<input class="btn btn-primary" type="submit" value="Iniciar sesión">
</div>
</form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>






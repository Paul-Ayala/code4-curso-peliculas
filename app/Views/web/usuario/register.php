<?= $this->extend('Layouts/web') ?>
<?= $this->section('header') ?>
Registro de usuario
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
<form action="<?= route_to('usuario.register_post') ?>" method="post">
<label for="usuario">Nombre del usuario:</label>
<input type="text" name="usuario" id="usuario">
<br/>
<label for="email">Email del usuario:</label>
<input type="text" name="email" id="email">
<br/>
<label for="contrasena">Contraseña del usuario:</label>
<input type="password" name="contrasena" id="contrasena">
<br/>
<input type="submit" value="Iniciar sesión">
</form>

<?= $this->endSection() ?>






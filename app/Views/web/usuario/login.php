<?= $this->extend('Layouts/web') ?>
<?= $this->section('header') ?>
Login
<?= $this->endSection() ?>
<?= $this->section('contenido') ?>
<?= view('partials/_form-error') ?>
<form action="<?= route_to('usuario.login_post') ?>" method="post">
<label for="email">Email del usuario:</label>
<input type="text" name="email" id="email">
<br/>
<label for="contrasena">Contraseña del usuario:</label>
<input type="password" name="contrasena" id="contrasena">
<br/>
<input type="submit" value="Iniciar sesión">
</form>

<?= $this->endSection() ?>






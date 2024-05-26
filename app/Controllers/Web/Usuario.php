<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Usuario extends BaseController
{
    public function crear_usuario()
    {
        $usuarioModel = new UsuarioModel();

        $usuarioModel->insert(
                [
                    'usuario' => 'admin',
                    'email' => 'admin@gmail.com',
                    'contrasena' =>  $usuarioModel->contrasenaHash('12345'),
                ]
            );
    }

    function probar_contrasena()
    {
        $usuarioModel = new UsuarioModel();

        echo $usuarioModel->contrasenaVerificar('12345', '$2y$10$T6EIUv0XmrernxZiqUThBu6jemyjjkGOM5EczEQIlIorUW2Sz3bVi');
    }

    function login() {
        echo view('web/usuario/login');
    }

    function login_post() {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');
        $usuario = $usuarioModel->select('id, usuario, email, contrasena, tipo')
        ->orWhere('email', $email)
        ->orWhere('usuario', $email)
        ->first();

        if (!$usuario) {
            return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalida');
        }
        if ($usuarioModel->contrasenaVerificar($contrasena, $usuario->contrasena)) {
            $session = session();
            unset($usuario->contrasena);
            $session->set('usuario', $usuario);

            return redirect()->to('/dashboard/categoria')->with('mensaje', "Bienvenid@ $usuario->usuario");
        }
        return redirect()->back()->with('mensaje', 'Usuario y/o contraseña invalida');

    }

    function register() {
        echo view('web/usuario/register');
    }

    function register_post() {
        $usuarioModel = new UsuarioModel();


        if ($this->validate('usuariosVal')) {
            $usuarioModel->insert([
                'usuario'=>$this->request->getPost('usuario'),
                'email'=>$this->request->getPost('email'),
                'contrasena'=>$usuarioModel->contrasenaHash($this->request->getPost('contrasena')),

            ]);

            return redirect()->to(route_to('usuario.login'))->with('mensaje', "Usuario registrado con éxito");

        }
        session()->setFlashdata([
            'validation' => $this->validator
        ]);
        return redirect()->back()->withInput();
    }

    
    function logout() {
        session()->destroy;
        return redirect()->to(route_to('usuario.login'));
    }
    
}

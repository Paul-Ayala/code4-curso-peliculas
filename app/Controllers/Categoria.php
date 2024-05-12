<?php 

namespace App\Controllers;

use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    public function index()
    {
        $categoriaModel = new CategoriaModel();
       
       echo view('categoria/index', [
        'categorias' => $categoriaModel->findAll(),
       ]);
    }

    //Muestra los datos del registro seleccionado
    public function show($id){
        $categoriaModel = new CategoriaModel();
        echo view('/categoria/show', [
            'categoria' => $categoriaModel->find($id)
        ]);
    }
    //Formulario para crear
    public function new(){
        echo view('categoria/new', [
            'categoria' => [
                'titulo' => ''
            ]
        ]);
    }
    //Función que crea
    public function create(){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->insert([
            'titulo' => $this->request->getPost('titulo')
        ]);

        echo 'Creado con éxito';
    }

    //Formulario para actualizar
    public function edit($id){
        $categoriaModel = new CategoriaModel();
        echo view('categoria/edit', [
            'categoria' => $categoriaModel->find($id)
        ]);
    }

    //Función que actualiza
    public function update($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
        ]);

        echo 'Actualizado con éxito';
    }
    //Función para eliminar
    public function delete($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);

        echo 'Eliminado con éxito';
    }

}

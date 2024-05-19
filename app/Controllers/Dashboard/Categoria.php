<?php 

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class Categoria extends BaseController
{

    public function index()
    {
        session()->set('key', 4);
        $categoriaModel = new CategoriaModel();
       
       echo view('dashboard/categoria/index', [
        'categorias' => $categoriaModel->findAll(),
       ]);
    }

    //Muestra los datos del registro seleccionado
    public function show($id){
        
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/categoria/show', [
            'categoria' => $categoriaModel->find($id)
        ]);
    }
    //Formulario para crear
    public function new(){
        echo view('dashboard/categoria/new', [
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

        return redirect()->to('dashboard/categoria')->with('mensaje', 'Registro creado con éxito');
    }

    //Formulario para actualizar
    public function edit($id){
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/categoria/edit', [
            'categoria' => $categoriaModel->find($id)
        ]);
    }

    //Función que actualiza
    public function update($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->update($id, [
            'titulo' => $this->request->getPost('titulo')
        ]);

        return redirect()->back()->with('mensaje', 'Registro actualizado con éxito');
    }
    //Función para eliminar
    public function delete($id){
        $categoriaModel = new CategoriaModel();
        $categoriaModel->delete($id);
        //segunda forma de mandar mensaje flash
        session()->setFlashdata('mensaje', 'Registro eliminado con éxito.');
        return redirect()->back();
        //primera forma
        // return redirect()->back()->with('mensaje', 'Registro eliminado con éxito');
    }

}

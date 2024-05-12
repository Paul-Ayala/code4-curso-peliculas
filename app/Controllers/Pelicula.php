<?php

namespace App\Controllers;

use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    // public function index()
    // {
    //     $peliculaModel = new PeliculaModel();
    //     //var_dump($peliculaModel->findAll()); imprime en pantalla los datos
    //     $data = ['peliculas' => $peliculaModel->findAll(),
    //              'nombreVariableVista2' => 'Contenido 2',
    //              'nombreVariableVista3' => 7,
    //              'miArray' =>[1,2,3,4,5]];
    //    echo view('index', $data);
    // }
    public function index()
    {
        $peliculaModel = new PeliculaModel();
       
       echo view('pelicula/index', [
        'peliculas' => $peliculaModel->findAll(),
       ]);
    }

    //Muestra los datos del registro seleccionado
    public function show($id){
        $peliculaModel = new PeliculaModel();
        // var_dump($peliculaModel->find($id));
        echo view('/pelicula/show', [
            'pelicula' => $peliculaModel->find($id)
        ]);
    }
    //Formulario para crear
    public function new(){
        //esto funciona, si no se hubiera reutilizado para _form, ya que ahí espera value, pero para crear no llevan los campos value
        // echo view('pelicula/new');
        echo view('pelicula/new', [
            'pelicula' => [
                'titulo' => '',
                'descripcion' => ''
            ]
        ]);
    }
    //Función que crea
    public function create(){
        $peliculaModel = new PeliculaModel();
        $peliculaModel->insert([
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        echo 'Creado con éxito';

        // var_dump($this->request->getPost('titulo'));
        //equivalente:  $_POST['titulo'];
    }

    //Formulario para actualizar
    public function edit($id){
        $peliculaModel = new PeliculaModel();
        echo view('pelicula/edit', [
            'pelicula' => $peliculaModel->find($id)
        ]);
    }

    //Función que actualiza
    public function update($id){
        $peliculaModel = new PeliculaModel();
        $peliculaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        echo 'Actualizado con éxito';
    }

//Función que elimina, se podría usar antes pelicula/remove/, pero esta serviría sí tenemos como un dialogo de confirmación o así...
    public function delete($id){
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);

        echo 'Eliminado con éxito';
    }




}

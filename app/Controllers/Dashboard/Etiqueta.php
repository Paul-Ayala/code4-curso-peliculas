<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;

class Etiqueta extends BaseController
{
    public function index()
    {

        $etiquetaModel = new EtiquetaModel();

        $data = [
            'etiquetas' => $etiquetaModel->select('etiquetas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = etiquetas.categoria_fk')
            ->paginate(10),
            'pager' => $etiquetaModel->pager
            // ->find(),
        ];
       
       echo view('dashboard/etiqueta/index', $data);
    }

    public function show($id){
        $etiquetaModel = new EtiquetaModel();
        echo view('dashboard/etiqueta/show', [
            'etiqueta' => $etiquetaModel->find($id)
        ]);
    }
    public function new(){
        $categoriaModel = new CategoriaModel();
        echo view('dashboard/etiqueta/new', [
            'etiqueta' => new EtiquetaModel(),
            'categorias' => $categoriaModel->find(),
        ]);

    }
    public function create(){
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetasVal')) {
            $etiquetaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_fk' => $this->request->getPost('categoria_fk')
            ]);    
        }else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back()->withInput();
        }
        return redirect()->to('/dashboard/etiqueta')->with('mensaje', 'Registro creado con éxito');
        
    }

    public function edit($id){
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();


        echo view('dashboard/etiqueta/edit', [
            'etiqueta' => $etiquetaModel->find($id),
            'categorias' => $categoriaModel->find(),
        ]);
    }

    public function update($id){
        $etiquetaModel = new EtiquetaModel();

        if ($this->validate('etiquetasVal')) {
            $etiquetaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'categoria_fk' => $this->request->getPost('categoria_fk')
        ]);
        }else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back()->withInput();
        }
        return redirect()->back()->with('mensaje', 'Registro actualizado con éxito');
    }

    public function delete($id){
        $etiquetaModel = new EtiquetaModel();
        $etiquetaModel->delete($id);

        return redirect()->back()->with('mensaje', 'Registro eliminado con éxito');
    }

}

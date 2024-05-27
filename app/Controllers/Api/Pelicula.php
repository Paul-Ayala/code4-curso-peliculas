<?php
//Sí no se agrega el namespace en groups no va a encontrar el archivo
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';
    // protected $format = 'xml';

    public function index() {
        return $this->respond($this->model->findAll());
    }
    public function show($id = null) {
        return $this->respond($this->model->find($id));
    }

    public function create() {

        if ($this->validate('peliculasVal')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion')
            ]);
        }else {
            return $this->respond($this->validator->getErrors(), 400);
        }
        return $this->respond($id);
    }

    public function update($id = null){
        if ($this->validate('peliculasVal')) {
            $this->model->update($id, [
            'titulo' => $this->request->getRawInput()['titulo'],
            'descripcion' => $this->request->getRawInput()['descripcion'],
        ]);

        }else {
            //ERRORES INDIVIDUALES
            if ($this->validator->getError('titulo')) {
                return $this->respond($this->validator->getErrors('titulo'), 400);
            }
            if ($this->validator->getError('descripcion')) {
                return $this->respond($this->validator->getErrors('descripcion'), 400);
            }
            //ERROR GENERAL
            // return $this->respond($this->validator->getErrors(), 400);
        }
        return $this->respond($id);
    }

    public function delete($id = null){
        $this->model->delete($id);
        return $this->respond('OK');
    }


}

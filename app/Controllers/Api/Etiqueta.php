<?php
//Sí no se agrega el namespace en groups no va a encontrar el archivo
namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class Etiqueta extends ResourceController{

    protected $modelName = 'App\Models\EtiquetaModel';
    // protected $format = 'json';
    // protected $format = 'xml';

    public function index() {
        return $this->respond($this->model->findAll());
    }
    public function show($id = null) {
        return $this->respond($this->model->find($id));
    }

    public function create() {

        if ($this->validate('etiquetasVal')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'categoria_fk' => $this->request->getPost()['categoria_fk'],
            ]);
        }else {
            return $this->respond($this->validator->getErrors(), 400);
        }
        return $this->respond($id);
    }

    public function update($id = null){
        if ($this->validate('etiquetasVal')) {
            $this->model->update($id, [
            'titulo' => $this->request->getRawInput()['titulo'],
            'categoria_fk' => $this->request->getRawInput()['categoria_fk'],
        ]);

        }else {
            //ERRORES INDIVIDUALES
            if ($this->validator->getError('titulo')) {
                return $this->respond($this->validator->getErrors('titulo'), 400);
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

<?php
//Sí no se agrega el namespace en groups no va a encontrar el archivo
namespace App\Controllers\Api;

use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use CodeIgniter\RESTful\ResourceController;

class Pelicula extends ResourceController{

    protected $modelName = 'App\Models\PeliculaModel';
    protected $format = 'json';
    // protected $format = 'xml';

    public function index() {
        return $this->respond($this->model->findAll());
    }
    public function paginado() {
        return $this->respond($this->model->paginate(10));
    }
    public function paginado_full() {
        $peliculas = $this->model
        ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
            $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
            $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
        })
        ->when($this->request->getGet('categoria_fk'), static function ($query, $categoriaFK) {
            $query->where('peliculas.categoria_fk', $categoriaFK);
        })
        ->when($this->request->getGet('etiqueta_fk'), static function ($query, $etiquetaFk) {
            $query->where('etiquetas.id', $etiquetaFk);
        })
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left');


        $peliculas =  $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate();



        return $this->respond($peliculas);
    }


    public function index_por_categoria($categoriaFK) {
        $peliculas = $this->model
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left')
        ->where('categorias.id', $categoriaFK)
        ->groupBy('peliculas.id')->paginate();

        return $this->respond($peliculas);
    }

    public function index_por_etiqueta($etiquetaFK) {
        $peliculas = $this->model
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left')
        ->where('etiquetas.id', $etiquetaFK);

        $peliculas =  $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate();

        return $this->respond($peliculas);
    }



    public function show($id = null) {
        $data = [
            'pelicula' => $this->model->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_fk')->find($id),
            'imagenes' => $this->model->getImagenesById($id),
            'etiquetas' => $this->model->getEtiquetasById($id),
        ];
        return $this->respond($data);
    }

    public function create() {

        if ($this->validate('peliculasVal')) {
            $id = $this->model->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_fk' => $this->request->getPost('categoria_fk')
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
            'categoria_fk' => $this->request->getRawInput()['categoria_fk']
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

    public function etiquetas_post($id) {
        $peliculaEtiquetaModel = new PeliculaEtiquetaModel();
        $etiquetaFk = $this->request->getPost('etiqueta_fk');
        $peliculaFk = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_fk', $etiquetaFk)->where('pelicula_fk', $peliculaFk)->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_fk' => $peliculaFk,
                'etiqueta_fk' => $etiquetaFk,

            ]);
        }

        // return redirect()->back();
        return $this->respond('ok');


    }

    public function etiqueta_delete($peliculaFk, $etiquetaFk) {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_fk', $etiquetaFk)
                         ->where('pelicula_fk', $peliculaFk)
                         ->delete();

                         echo '{"mensaje": "Eliminado"}';
        
        // return $this->response->setJSON(['mensaje' => 'Eliminado']);
        return $this->respond('ok');

    }



    function upload($peliculaFk) {
        helper('filesystem');
        if ($imagefile = $this->request->getFile('imagen')) {
            // UPLOAD
            if ($imagefile->isValid()) {
                // Definir reglas de validación
                $validationRules = [
                    'imagen' => [
                        'uploaded[imagen]',
                        'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[imagen,4096]',
                    ],
                ];
                if ($this->validate($validationRules)) {
                    //para renombrar con un nombre random
                    $imageNombre = $imagefile->getRandomName();
                    // $imageNombre = $imagefile->getName();
                    $ext = $imagefile->guessExtension();
                    //Para que se almacenen en la carpeta writeable
                    // $imagefile->move(WRITEPATH . 'uploads/peliculas', $imageNombre);
                    $imagefile->move('../public/uploads/peliculas', $imageNombre);
                    $imagenModel = new ImagenModel();
                    $filePath = '../public/uploads/peliculas/' . $imageNombre;
                    $fileInfo = get_file_info($filePath);
                    $imagenId = $imagenModel->insert([
                        'imagen' => $imageNombre,
                        'extension' => $ext,
                        'data' => json_encode($fileInfo)
                    ]);
                    $imagenModel = new PeliculaImagenModel();
                    $imagenModel->insert([
                    'imagen_fk' => $imagenId,
                    'pelicula_fk' => $peliculaFk,
                    ]);
                    return $this->respond('OH ME VENGOOOO');
                } else {
                    // return $this->validator->listErrors();
                }
            }
        }
        return $this->respond('SE EQUIVOCO CEROTE LEA BIEN PENDEJO NO SEA HIJUEPUTA');
    }

    public function borrar_imagen($peliculaFk, $imagenFk) {
        $imagenModel = new ImagenModel();
        $peliculaImagenModel = new PeliculaImagenModel();
        $imagen = $imagenModel->find($imagenFk);
        //archivos
        if ($imagen == null) {
            return $this->respond('esa mrd está en paraguay NO EXISTE MAHE, YA TE DIJE N-O, no, LA SIGUIENTE ES ACOSO');

        }
        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;

        // eliminar pivote
        $peliculaImagenModel->where('imagen_fk', $imagenFk)->where('pelicula_fk', $peliculaFk)->delete();
        
        if ($peliculaImagenModel->where('imagen_fk', $imagenFk)->countAllResults() == 0) {
        //eliminar toda la imagen
        unlink($imageRuta);
        $imagenModel->delete($imagenFk);
        }
        // return redirect()->back()->with('mensaje', 'Imagen Eliminada');
        return $this->respond('ok');


    }


}

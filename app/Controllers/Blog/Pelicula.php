<?php
namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController{
    public function index() {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculas = $peliculaModel
        // se agrega when y se pone lo qué estaba en el if comentado, es otrta forma de hacerlo
        ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
            $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
            $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
        })
        ->when($this->request->getGet('categoria_fk'), static function ($query, $categoriaFK) {
            $query->where('peliculas.categoria_fk', $categoriaFK);
        })
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left');

        // if ($buscar = $this->request->getGet('buscar')) {
        //     $peliculas = $peliculas->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
        //     $peliculas = $peliculas->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
        // }

        // if ($categoriaFK = $this->request->getGet('categoria_fk')) {
        //     $peliculas = $peliculas->where('peliculas.categoria_fk', $categoriaFK);
        // }
        if ($etiquetaFK = $this->request->getGet('etiqueta_fk')) {
            $peliculas = $peliculas->where('etiquetas.id', $etiquetaFK);
        }

        $peliculas =  $peliculas->groupBy('peliculas.id')->paginate();
        $categoriaFK = $this->request->getGet('categoria_fk');
        $data = [
            'peliculas' => $peliculas,
            'categorias' => $categoriaModel->findAll(),
            'etiquetas'=>$categoriaFK == '' ? [] : $etiquetaModel->where('categoria_fk', $categoriaFK)->findAll(),
            'pager' => $peliculaModel->pager,
            'categoria_fk' => $categoriaFK,
            'etiqueta_fk' => $this->request->getGet('etiqueta_fk'),
            'buscar' => $this->request->getGet('buscar'),
        ];
        echo view('blog/pelicula/index', $data);
    }

    public function show($id) {
        $peliculaModel = new PeliculaModel();
        $data = [
            'pelicula' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_fk')->find($id),
            'imagenes' => $peliculaModel->getImagenesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
        ];
        echo view('blog/pelicula/show', $data);
    }

    public function etiquetas_por_categoria($categoriaFK) {
        $etiquetaModel = new EtiquetaModel();
        return $this->response->setJSON($etiquetaModel->where('categoria_fk', $categoriaFK)->findAll());
    }
    public function index_por_categoria($categoriaFK) {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $categoria = $categoriaModel->find($categoriaFK);
        $peliculas = $peliculaModel
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left')
        ->where('categorias.id', $categoriaFK);

        $peliculas =  $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate();
        $data = [
            'peliculas' => $peliculas,
            'categoria' => $categoria,
            'pager' => $peliculaModel->pager,
        ];
        echo view('blog/pelicula/index_por_categoria', $data);
    }

    public function index_por_etiqueta($etiquetaFK) {
        $peliculaModel = new PeliculaModel();
        $etiquetaModel = new EtiquetaModel();
        $etiqueta = $etiquetaModel->find($etiquetaFK);
        $peliculas = $peliculaModel
        // se agrega when y se pone lo qué estaba en el if comentado, es otrta forma de hacerlo
        ->when($this->request->getGet('buscar'), static function ($query, $buscar) {
            $query->groupStart()->orLike('peliculas.titulo', $buscar, 'both');
            $query->orLike('peliculas.descripcion', $buscar, 'both')->groupEnd();
        })
        ->when($this->request->getGet('categoria_fk'), static function ($query, $categoriaFK) {
            $query->where('peliculas.categoria_fk', $categoriaFK);
        })
        ->select('peliculas.*, categorias.titulo as categoria, GROUP_CONCAT(DISTINCT(etiquetas.titulo)) as etiqueta, MAX(imagenes.imagen) as imagen')
        ->join('categorias', 'categorias.id = peliculas.categoria_fk')
        ->join('pelicula_etiqueta', 'pelicula_etiqueta.pelicula_fk = peliculas.id','left')
        ->join('etiquetas', 'etiquetas.id = pelicula_etiqueta.etiqueta_fk','left')
        ->join('pelicula_imagen', 'pelicula_imagen.pelicula_fk = peliculas.id','left')
        ->join('imagenes', 'imagenes.id = pelicula_imagen.imagen_fk','left')
        ->where('etiquetas.id', $etiquetaFK);

        $peliculas =  $peliculas->groupBy('peliculas.id');
        $peliculas = $peliculas->paginate();
        $data = [
            'peliculas' => $peliculas,
            'etiqueta' => $etiqueta,
            'pager' => $peliculaModel->pager,
        ];
        echo view('blog/pelicula/index_por_etiqueta', $data);
    }
    
}

?>
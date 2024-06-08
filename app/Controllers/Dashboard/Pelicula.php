<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use App\Models\ImagenModel;
use App\Models\PeliculaEtiquetaModel;
use App\Models\PeliculaImagenModel;
use App\Models\PeliculaModel;

class Pelicula extends BaseController
{
    // public function index()
    // {
    //     $peliculaModel = new PeliculaModel();
    ////var_dump($peliculaModel->findAll()); imprime en pantalla los datos
    //     $data = ['peliculas' => $peliculaModel->findAll(),
    //              'nombreVariableVista2' => 'Contenido 2',
    //              'nombreVariableVista3' => 7,
    //              'miArray' =>[1,2,3,4,5]];
    //    echo view('index', $data);
    // }
    public function index()
    {
        //equivale a SELECT * FROM `peliculas` LIMIT 20, 10
        $peliculaModel = new PeliculaModel();

        // $this->generar_imagen();
        // $this->asignar_imagen();


        // $db = \Config\Database::connect();
        // $builder = $db->table('peliculas');
        // return $builder->limit(10, 20)->getCompiledSelect();
        $data = [
            // 'peliculas' => $peliculaModel->select('peliculas.id, peliculas.titulo, peliculas.descripcion, peliculas.categoria_fk')->join('categorias', 'categorias.id = peliculas.categoria_fk')->find(),
            'peliculas' => $peliculaModel->select('peliculas.*, categorias.titulo as categoria')->join('categorias', 'categorias.id = peliculas.categoria_fk')->find(),
        ];
       
       echo view('dashboard/pelicula/index', $data);
    }

    //Muestra los datos del registro seleccionado
    public function show($id){
        $peliculaModel = new PeliculaModel();
        // $imagenModel = new ImagenModel();
        // var_dump($imagenModel->getPeliculasById(2));
        // var_dump($peliculaModel->getImagenesById($id));
        // var_dump($peliculaModel->find($id));
        echo view('dashboard/pelicula/show', [
            'pelicula' => $peliculaModel->find($id),
            'imagenes' => $peliculaModel->getImagenesById($id),
            'etiquetas' => $peliculaModel->getEtiquetasById($id),
        ]);
    }
    //Formulario para crear
    public function new(){
        //esto funciona, si no se hubiera reutilizado para _form, ya que ahí espera value, pero para crear no llevan los campos value
        // echo view('pelicula/new');

        //esto funciona si en el modelo el retun es array
        // echo view('dashboard/pelicula/new', [
        //     'pelicula' => [
        //         'titulo' => '',
        //         'descripcion' => ''
        //     ]
        // ]);
        $categoriaModel = new CategoriaModel();


        echo view('dashboard/pelicula/new', [
            'pelicula' => new PeliculaModel(),
            'categorias' => $categoriaModel->find(),
        ]);

    }
    //Función que crea
    public function create(){
        $peliculaModel = new PeliculaModel();

        if ($this->validate('peliculasVal')) {
            $peliculaModel->insert([
                'titulo' => $this->request->getPost('titulo'),
                'descripcion' => $this->request->getPost('descripcion'),
                'categoria_fk' => $this->request->getPost('categoria_fk')
            ]);
            return redirect()->to('/dashboard/pelicula')->with('mensaje', 'Registro creado con éxito');
    
            // var_dump($this->request->getPost('titulo'));
            //equivalente:  $_POST['titulo'];
        }else {
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back()->withInput();
        }
        
    }

    //Formulario para actualizar
    public function edit($id){
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();


        echo view('dashboard/pelicula/edit', [
            'pelicula' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->find(),
        ]);
    }

    //Función que actualiza
    public function update($id){
        $peliculaModel = new PeliculaModel();

        //validate va a buscar en el archivo Validation.php una variable con el nombre indicado en este caso peliculasVal
        if ($this->validate('peliculasVal')) {
            $peliculaModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'categoria_fk' => $this->request->getPost('categoria_fk')
        ]);

        $this->asignar_imagen($id);

        //redirige a la anterior
        //redirige hacia la pagina indicada, recordar que esto se dibujaría con:
        //Datos de App.php:
        // $baseURL = 'http://codeigniter4.test/';
        // public string $indexPage = '';
        //ruta final a la cual va a redirigir: http://codeigniter4.test/dashboard/pelicula
        // return redirect()->to('/dashboard/pelicula');
        //redirección con ruta por nombre
        // return redirect()->route('test');
        }else {
            //eso nos sirve para imprimir todopds los errores, pero esoi no nos interesa
            // var_dump($this->validator->listErrors());
            // desde el controlador no vamos a hacer nada, si no desde la vista
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            return redirect()->back()->withInput();
        }

        return redirect()->back()->with('mensaje', 'Registro actualizado con éxito');


       

    }

//Función que elimina, se podría usar antes pelicula/remove/, pero esta serviría sí tenemos como un dialogo de confirmación o así...
    public function delete($id){
        $peliculaModel = new PeliculaModel();
        $peliculaModel->delete($id);

        return redirect()->back()->with('mensaje', 'Registro eliminado con éxito');
    }

    //ruta por nombre
    public function test(){
        echo 'test';
    }

    public function etiquetas($id) {
        $categoriaModel = new CategoriaModel();
        $etiquetaModel = new EtiquetaModel();
        $peliculaModel = new PeliculaModel();

        $etiquetas = [];

        if ($this->request->getGet('categoria_fk')) {
            $etiquetas = $etiquetaModel
            ->where('categoria_fk', $this->request->getGet('categoria_fk'))
            ->findAll();
        }

        echo view('dashboard/pelicula/etiquetas',[
            'peliculas' => $peliculaModel->find($id),
            'categorias' => $categoriaModel->findAll(),
            'categoria_fk' =>$this->request->getGet('categoria_fk'),
            'etiquetas' => $etiquetas,
        ]);


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

        return redirect()->back();


    }

    public function etiqueta_delete($peliculaFk, $etiquetaFk) {
        $peliculaEtiqueta = new PeliculaEtiquetaModel();
        $peliculaEtiqueta->where('etiqueta_fk', $etiquetaFk)
                         ->where('pelicula_fk', $peliculaFk)
                         ->delete();
        
        return $this->response->setJSON(['mensaje' => 'Eliminado']);
    }

    public function borrar_imagen($peliculaFk, $imagenFk) {
        $imagenModel = new ImagenModel();
        $peliculaModel = new PeliculaModel();
        $peliculaImagenModel = new PeliculaImagenModel();
        $imagen = $imagenModel->find($imagenFk);
        //archivos
        if ($imagen == null) {
            return 'no existe imagen';
        }
        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;

        // eliminar pivote
        $peliculaImagenModel->where('imagen_fk', $imagenFk)->where('pelicula_fk', $peliculaFk)->delete();
        
        if ($peliculaImagenModel->where('imagen_fk', $imagenFk)->countAllResults() == 0) {
        //eliminar toda la imagen
        unlink($imageRuta);
        $imagenModel->delete($imagenFk);
        }
        return redirect()->back()->with('mensaje', 'Imagen Eliminada');

    }

    public function descargar_imagen($imagenFk) {
        $imagenModel = new ImagenModel();
        $imagen = $imagenModel->find($imagenFk);
        if ($imagen == null) {
            return 'no existe imagen';
        }
        $imageRuta = 'uploads/peliculas/' . $imagen->imagen;
        return $this->response->download($imageRuta, null)->setFileName('pokeIMG.png');

    }

    public function asignar_imagen($peliculaFk) {
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
                    $imagenId = $imagenModel->insert([
                        'imagen' => $imageNombre,
                        'extension' => $ext,
                        'data' => 'imagen paraguaya'
                    ]);

                    $imagenModel = new PeliculaImagenModel();
                    $imagenModel->insert([
                    'imagen_fk' => $imagenId,
                    'pelicula_fk' => $peliculaFk,
                    ]);
                } else {
                    return $this->validator->listErrors();
                }
            }
        }
    }
    
    public function image($image = null) {
        if (!$image) {
            $image = $this->request->getGet('image');
        }
    
        // Asegurarse de que la imagen no contenga caracteres no permitidos
        $image = basename($image);
    
        // Añadir la barra diagonal correcta
        $name = WRITEPATH . 'uploads/peliculas/' . $image;
    
        if (!file_exists($name)) {
            // Lanzar una excepción si el archivo no existe
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("La imagen no se encuentra en la ruta especificada chimbombim.");
        }
    
        $fp = fopen($name, 'rb');
        if (!$fp) {
            throw new \Exception("No se pudo abrir el archivo de imagen.");
        }
    
        // Detectar el tipo MIME de la imagen
        $mimeType = mime_content_type($name);
    
        header("Content-Type: " . $mimeType);
        header("Content-Length: " . filesize($name));
    
        fpassthru($fp);
        fclose($fp); // Cerrar el archivo después de pasar su contenido al navegador
        exit;
    }
    



}

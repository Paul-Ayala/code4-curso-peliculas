<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table = 'peliculas';
    // protected $returnType = 'array';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion', 'categoria_fk'];

    public function getImagenesById($id){
        return $this->select("i.*")
        ->join('pelicula_imagen as pi', 'pi.pelicula_fk = peliculas.id')
        ->join('imagenes as i', 'i.id = pi.imagen_fk')
        ->where('peliculas.id', $id)->findAll();
    }

    public function getEtiquetasById ($id){
        return $this->select('e.*')
        ->join('pelicula_etiqueta as pe', 'pe.pelicula_fk = peliculas.id')
        ->join('etiquetas as e', 'e.id = pe.etiqueta_fk')
        ->where('peliculas.id', $id)
        ->findAll();
    }
}

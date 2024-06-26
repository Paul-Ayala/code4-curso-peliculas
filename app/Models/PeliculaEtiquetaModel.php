<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaEtiquetaModel extends Model
{
    protected $table            = 'pelicula_etiqueta';
    protected $primaryKey       = 'id';
    protected $returnType = 'object';
    protected $allowedFields    = ['pelicula_fk', 'etiqueta_fk'];

}
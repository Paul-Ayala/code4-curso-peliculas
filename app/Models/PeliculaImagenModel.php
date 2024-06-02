<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaImagenModel extends Model
{
    protected $table            = 'pelicula_imagen';
    protected $returnType = 'object';

    protected $allowedFields    = ['pelicula_fk', 'imagen_fk'];
}

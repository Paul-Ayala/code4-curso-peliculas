<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table = 'peliculas';
    // protected $returnType = 'array';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'descripcion'];
}

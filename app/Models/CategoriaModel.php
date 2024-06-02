<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table  = 'categorias';
        // protected $returnType = 'array';
    protected $returnType = 'object';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo'];
}

//usar php spark make:model CategoriaModel para crear categorias
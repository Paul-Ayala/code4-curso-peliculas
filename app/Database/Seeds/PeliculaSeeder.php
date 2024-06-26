<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\PeliculaModel;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new PeliculaModel();
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->limit(7)->findAll();
        $peliculaModel->where('id >=', 1)->delete();
        foreach ($categorias as $categoria) {
            for ($i=0; $i < 20; $i++) { 
                $peliculaModel->insert([
                    'titulo' => "Pelicula $i",
                    'categoria_fk' => $categoria->id,
                    'descripcion' => "Peliuculas de prueba",
                ]);
            }
        }
    }
}

<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use App\Models\EtiquetaModel;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new EtiquetaModel();
        $categoriaModel = new CategoriaModel();
        $categorias = $categoriaModel->limit(7)->findAll();
        $etiquetaModel->where('id >=', 1)->delete();
        foreach ($categorias as $categoria) {
            for ($i=0; $i < 20; $i++) { 
                $etiquetaModel->insert([
                    'titulo' => "Tag - $i $categoria->titulo",
                    'categoria_fk' => $categoria->id,
                ]);
            }
        }
    }
}

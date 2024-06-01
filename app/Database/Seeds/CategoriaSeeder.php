<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        // $this->db->table('categorias');
        // $this->db->table('categorias')->where('id >=', 1)->delete();
        $categoriaModel = new CategoriaModel();
        $categoriaModel->where('id >=', 1)->delete();
        for ($i=0; $i < 20; $i++) { 
            $categoriaModel->insert([
                'titulo' => "Categoria test $i"
            ]);
        }
        // $this->db->table('categorias')->insert([
        //     'titulo' => 'tests Seeder'
        // ]);
    }
}

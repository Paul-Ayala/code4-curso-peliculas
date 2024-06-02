<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgregarCategoriaPelicula extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peliculas',[
            'COLUMN categoria_fk INT(10) UNSIGNED',
            'CONSTRAINT products_categoria_fk_foreign FOREIGN KEY(categoria_fk) REFERENCES categorias(id)',
        ]);
    }

    public function down()
    {
        $this->forge->dropForeignKey('peliculas', 'products_categoria_fk_foreign');
        $this->forge->dropColumn('peliculas', 'categoria_fk');
    }
}

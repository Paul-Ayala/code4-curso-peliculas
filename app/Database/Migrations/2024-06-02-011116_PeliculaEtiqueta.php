<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PeliculaEtiqueta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pelicula_fk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,

            ],
            'etiqueta_fk' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ],
        ]);

        $this->forge->addForeignKey('pelicula_fk', 'peliculas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('etiqueta_fk', 'etiquetas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelicula_etiqueta');
    }

    public function down()
    {
        $this->forge->dropTable('pelicula_etiqueta');
    }
}

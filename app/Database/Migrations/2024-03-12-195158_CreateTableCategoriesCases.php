<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCategoriesCases extends Migration
{
    public function up()
    {
        //Crear tabla categorias casos
        $this->forge->addField([
            'CTCS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'CTCS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'CTCS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
        $this->forge->addPrimaryKey('CTCS_PK');
        $this->forge->createTable('categoriescase');
        $this->forge->processIndexes('categoriescase');
    }

    public function down()
    {
        $this->forge->dropTable('categoriescase');
    }
}

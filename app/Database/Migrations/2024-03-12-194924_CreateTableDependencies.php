<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDependencies extends Migration
{
    public function up()
    {
        //Crear tabla dependencias
        $this->forge->addField([
            'DPND_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'DPND_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'DPND_description' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
        $this->forge->addPrimaryKey('ENTS_PK');
        $this->forge->createTable('dependencies');
        $this->forge->processIndexes('dependencies');
    }

    public function down()
    {
        $this->forge->dropTable('dependencies');
    }
}

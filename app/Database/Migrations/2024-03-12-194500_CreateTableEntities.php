<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableEntities extends Migration
{
    public function up()
    {
        //Crear tabla entidades
        $this->forge->addField([
            'ENTS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'ENTS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'ENTS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ]
        ]);
        $this->forge->addPrimaryKey('ENTS_PK');
        $this->forge->createTable('entities');
        $this->forge->processIndexes('entities');
    }

    public function down()
    {
        $this->forge->dropTable('entities');
    }
}

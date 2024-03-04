<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatesUsers extends Migration
{
    public function up()
    {
        
        //Crear tabla estado de usuarios
        $this->forge->addField([
            'STTS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'STTS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'STTS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ]
        ]);
        $this->forge->addPrimaryKey('STTS_PK');
        $this->forge->createTable('statesusers');
        $this->forge->processIndexes('statesusers');

        

    }

    public function down()
    {
        $this->forge->dropTable('statesusers');
    }
}

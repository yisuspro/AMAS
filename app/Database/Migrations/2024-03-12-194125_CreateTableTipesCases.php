<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTipesCases extends Migration
{
    public function up()
    {
         //Crear tabla tipo de casos
         $this->forge->addField([
            'TPCS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'TPC_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'TPC_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ]
        ]);
        $this->forge->addPrimaryKey('TPCS_PK');
        $this->forge->createTable('tipescases');
        $this->forge->processIndexes('tipescases');
    }

    public function down()
    {
        $this->forge->dropTable('tipescases');
    }
}

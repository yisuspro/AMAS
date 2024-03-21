<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatesCases extends Migration
{
    public function up()
    {
        //Crear tabla estado de casos
        $this->forge->addField([
            'STCS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'STCS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'STCS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
        ]);
        $this->forge->addPrimaryKey('STCS_PK');
        $this->forge->createTable('statescases');
        $this->forge->processIndexes('statescases');

         //Crear tabla grupos casos
         $this->forge->addField([
            'GRPS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'GRPS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'GRPS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ]
        ]);
        $this->forge->addPrimaryKey('GRPS_PK');
        $this->forge->createTable('groups');
        $this->forge->processIndexes('groups');
    }

    public function down()
    {
        $this->forge->dropTable('statescases');
        $this->forge->dropTable('groups');
    }
}

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
            'TPCS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'TPCS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],            
            'TPCS_FK_group' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('TPCS_PK');
        $this->forge->addKey('TPCS_FK_group',false); 
        $this->forge->createTable('tipescases');
        $this->forge->addForeignKey('TPCS_FK_group', 'groups', 'GRPS_PK','cascade','cascade','FK_tipes_groups');
        $this->forge->processIndexes('tipescases');
    }

    public function down()
    {
        $this->forge->dropTable('tipescases');
    }
}

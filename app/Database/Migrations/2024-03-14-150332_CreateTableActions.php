<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableActions extends Migration
{
    public function up()
    {
        // crear tabla acciones
        $this->forge->addField([
            'ACTN_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'ACTN_modified_record' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'ACTN_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ACTN_FK_case' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('ACTN_PK');
        $this->forge->addKey('ACTN_FK_case',false);  
        $this->forge->createTable('actions');
        $this->forge->addForeignKey('ACTN_FK_case', 'cases', 'CASE_PK','cascade','cascade','FK_actions_cases');
    }

    public function down()
    {
        $this->forge->dropTable('actions');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableObservations extends Migration
{
    public function up()
    {
        // crear tabla observaciones
        $this->forge->addField([
            'OBSV_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'OBSV_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'OBSV_description' => [
                'type' => 'TEXT'
            ],
            'OBSV_FK_case' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('OBSV_PK');
        $this->forge->addKey('OBSV_FK_case',false);  
        $this->forge->createTable('observations');
        $this->forge->addForeignKey('OBSV_FK_case', 'cases', 'CASE_PK','cascade','cascade','FK_observations_cases');
    }

    public function down()
    {
        $this->forge->dropTable('observations');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCases extends Migration
{
    public function up()
    {
        // crear tabla casos
        $this->forge->addField([
            'CASE_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'CASE_number' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'CASE_date_reception' => [
                'type' => 'DATE'
            ],
            'CASE_date_solution' => [
                'type' => 'DATE'
            ],
            'CASE_FK_agent' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_tipe_case' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_state_case' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_enties' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_dependence' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_case_categorie' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'CASE_FK_app' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('CASE_PK');
        $this->forge->addKey('CASE_FK_agent',false); 
        $this->forge->addKey('CASE_FK_tipe_case',false); 
        $this->forge->addKey('CASE_FK_state_case',false); 
        $this->forge->addKey('CASE_FK_enties',false); 
        $this->forge->addKey('CASE_FK_dependence',false); 
        $this->forge->addKey('CASE_FK_case_categorie',false); 
        $this->forge->addKey('CASE_FK_app',false); 
        $this->forge->createTable('cases');
        $this->forge->addForeignKey('CASE_FK_agent', 'users', 'USER_PK','cascade','cascade','FK_cases_users');
        $this->forge->addForeignKey('CASE_FK_tipe_case', 'tipescases', 'TPCS_PK','cascade','cascade','FK_cases_types');
        $this->forge->addForeignKey('CASE_FK_state_case', 'statescases', 'STCS_PK','cascade','cascade','FK_cases_states');
        $this->forge->addForeignKey('CASE_FK_enties', 'entities', 'ENTS_PK','cascade','cascade','FK_cases_entities');
        $this->forge->addForeignKey('CASE_FK_dependence', 'dependencies', 'DPND_PK','cascade','cascade','FK_cases_dependencies');
        $this->forge->addForeignKey('CASE_FK_case_categorie', 'categoriescase', 'CTCS_PK','cascade','cascade','FK_cases_categories');
        $this->forge->addForeignKey('CASE_FK_app', 'apps', 'APPS_PK','cascade','cascade','FK_cases_apps');
        $this->forge->processIndexes('cases');
    }

    public function down()
    {
        $this->forge->dropTable('cases');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAppsPersons extends Migration
{
    public function up()
    {
        // crear tabla aplicaciones personas
        $this->forge->addField([
            'APPR_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'APPR_FK_app' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'APPR_FK_person' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'APPR_state' => [
                'type' => 'INT',
            ],
            'APPR_confidentiality' => [
                'type' => 'BINARY',
            ],  
            'APPR_date_validity' => [
                'type' => 'DATE',
            ],
            'APPR_ID_app' => [
                'type' => 'INT',
            ],
            
        ]);
        $this->forge->addPrimaryKey('APPR_PK');
        $this->forge->addKey('APPR_FK_app',false);  
        $this->forge->addKey('APPR_FK_person',false);  
        $this->forge->createTable('appspersons');
        $this->forge->addForeignKey('APPR_FK_app', 'apps', 'APPS_PK','cascade','cascade','FK_apps_persons');
        $this->forge->addForeignKey('APPR_FK_person', 'persons', 'PRSN_PK','cascade','cascade','FK_persons_apps');
        $this->forge->processIndexes('appspersons');
    }

    public function down()
    {
        //
        $this->forge->DropTable('appspersons');
    }
}

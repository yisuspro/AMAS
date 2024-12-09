<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableDocumentsPersons extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'DCPR_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'DCPR_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'DCPR_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'DCPR_location' => [
                'type' => 'VARCHAR',
                'constraint' => 225,
            ],
            'DCPR_state' => [
                'type' => 'INT',
            ],
            'DCPR_FK_person' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],  
            'DCPR_FK_typedocument' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            
        ]);
        $this->forge->addPrimaryKey('DCPR_PK');
        $this->forge->addKey('DCPR_FK_person',false);  
        $this->forge->addKey('DCPR_FK_typedocument',false);  
        $this->forge->createTable('documentspersons');
        $this->forge->addForeignKey('DCPR_FK_person', 'persons', 'PRSN_PK','cascade','cascade','FK_documents_persons');
        $this->forge->addForeignKey('DCPR_FK_typedocument', 'typesdocuments', 'TPDC_PK','cascade','cascade','FK_documents_types');
        $this->forge->processIndexes('documentspersons');
    }

    public function down()
    {
        //
        $this->forge->DropTable('documentspersons');
    }
}

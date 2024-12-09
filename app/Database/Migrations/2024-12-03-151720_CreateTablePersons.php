<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePersons extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'PRSN_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'PRSN_document' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'PRSN_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'PRSN_email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'PRSN_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'PRSN_position' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
        ]);
        $this->forge->addPrimaryKey('PRSN_PK');
        $this->forge->createTable('persons');
        $this->forge->processIndexes('persons');
    }

    public function down()
    {
        //
        $this->forge->DropTable('persons');
    }
}

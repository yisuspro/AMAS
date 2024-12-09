<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTypesDocuments extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'TPDC_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'TPDC_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'TPDC_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'TPDC_state' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addPrimaryKey('TPDC_PK');
        $this->forge->createTable('typesdocuments');
        $this->forge->processIndexes('typesdocuments');
    }

    public function down()
    {
        //
        $this->forge->DropTable('typesdocuments');
    }
}

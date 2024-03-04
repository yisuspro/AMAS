<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePermissions extends Migration
{
    public function up()
    {
        //
        //Crear tabla permissions
        $this->forge->addField([
            'PRMS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'PRMS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'PRMS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'PRMS_system_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'PRMS_date_create' => [
                'type' => 'DATE',
            ],
            'PRMS_date_update' => [
                'type' => 'DATE',
            ],
            'PRMS_user_create' => [
                'type' => 'INT',
            ],
            'PRMS_user_update' => [
                'type' => 'INT',
            ]
        ]);
        
        $this->forge->addPrimaryKey('PRMS_PK');
        $this->forge->createTable('permissions');
        $this->forge->processIndexes('permissions');
    }

    public function down()
    {
        $this->forge->dropTable('permissions');
    }
}

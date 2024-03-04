<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRoles extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'ROLE_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'ROLE_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'ROLE_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'ROLE_date_create' => [
                'type' => 'DATE',
            ],
            'ROLE_date_update' => [
                'type' => 'DATE',
            ],
            'ROLE_FK_user_create' => [
                'type' => 'INT',
            ],
            'ROLE_FK_user_update' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addPrimaryKey('ROLE_PK');
        $this->forge->createTable('roles');
        $this->forge->processIndexes('roles');
    }

    public function down()
    {
        //
        $this->forge->dropTable('roles');
    }
}

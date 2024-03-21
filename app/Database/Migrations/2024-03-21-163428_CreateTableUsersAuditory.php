<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsersAuditory extends Migration
{
    public function up()
    {
        //Crear tabla auditoria de usuarios
        $this->forge->addField([
            'USDT_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'USDT_number_id' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'USDT_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
        ]);
        $this->forge->addPrimaryKey('USDT_PK');
        $this->forge->createTable('usersauditory');
        $this->forge->processIndexes('usersauditory');
    }

    public function down()
    {
        $this->forge->dropTable('usersauditory');
    }
}

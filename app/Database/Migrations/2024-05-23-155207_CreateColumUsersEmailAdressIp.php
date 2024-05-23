<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateColumUsersEmailAdressIp extends Migration
{
    public function up()
    {
        //
        $this->forge->addColumn('users', [
            'USER_email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'USER_address_ip' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}

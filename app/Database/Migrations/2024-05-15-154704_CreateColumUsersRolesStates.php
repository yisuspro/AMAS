<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateColumUsersRolesStates extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usersroles', [
            'USRL_state' => [
                'type' => 'INT',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}

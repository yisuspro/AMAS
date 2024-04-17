<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateColumPermissions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('permissions', [
            'PRMS_state' => [
                'type' => 'INT',
            ],
        ]);

        
        $this->forge->addColumn('roles', [
            'ROLE_state' => [
                'type' => 'INT',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}

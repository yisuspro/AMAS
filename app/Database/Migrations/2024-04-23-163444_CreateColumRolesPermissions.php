<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateColumRolesPermissions extends Migration
{
    public function up()
    {
        $this->forge->addColumn('rolespermissions', [
            'RLPR_state' => [
                'type' => 'INT',
            ],
        ]);

        
       
    }

    public function down()
    {
        //
    }
}

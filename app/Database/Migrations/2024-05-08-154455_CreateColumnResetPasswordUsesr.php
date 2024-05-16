<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateColumnResetPasswordUsesr extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'USER_reset_password' => [
                'type' => 'INT',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}

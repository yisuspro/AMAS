<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatesUsers extends Migration
{
    public function up()
    {
        //Crear tabla estado de usuarios
        $this->forge->addField([
            'STTS_PK' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'STTS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'STTS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ]
        ]);
        $this->forge->addKey('STTS_PK',true);
        $this->forge->createTable('statesusers');


        //Crear tabla roles
        $this->forge->addField([
            'ROLE_PK' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'ROLE_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'ROLE_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
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
        $this->forge->addKey('ROLE_PK',true);
        $this->forge->createTable('roles');

        
        //Crear tabla permissions
        $this->forge->addField([
            'PRMS_PK' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'PRMS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45
            ],
            'PRMS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'PRMS_system_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45
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
        $this->forge->addKey('PRMS_PK',true);
        $this->forge->createTable('permissions');


    }

    public function down()
    {
        //
        $this->forge->dropTable('statesusers');
    }
}

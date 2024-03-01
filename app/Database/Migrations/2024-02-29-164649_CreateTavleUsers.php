<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTavleUsers extends Migration
{
    public function up()
    {
        // crear tabla Usuarios
        $this->forge->addField([
            'USER_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'USER_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'USER_username' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'USER_password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'USER_date_create' => [
                'type' => 'DATE',
            ],
            'USER_date_update' => [
                'type' => 'DATE',
            ],
            'USER_FK_user_create' => [
                'type' => 'INT',
            ],
            'USER_FK_user_update' => [
                'type' => 'INT',
            ],
            'USER_FK_state_user' => [
                'type' => 'INT'
            ],
        ]);
        $this->forge->addKey('USER_PK',true);
        $this->forge->createTable('users');
        $this->forge->addForeignKey('USER_FK_state_user', 'statesusers', 'STTS_PK');

        // crear tabla usersroles
        $this->forge->addField([
            'USRL_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'USRL_FK_user' => [
                'type' => 'INT',
            ],
            'USRL_FK_rol' => [
                'type' => 'INT',
            ],
            'USRL_date_create' => [
                'type' => 'DATE',
            ],
            'USRL_date_update' => [
                'type' => 'DATE',
            ],
            'USRL_user_create' => [
                'type' => 'INT',
            ],
            'USRL_user_update' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addKey('USRL_PK',true);
        $this->forge->createTable('usersroles');
        $this->forge->addForeignKey('USRL_FK_user', 'users', 'USER_PK');
        $this->forge->addForeignKey('USRL_FK_rol', 'roles', 'ROLE_PK');

        // crear tabla roles_permissions
        $this->forge->addField([
            'RLPR_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'RLPR_FK_rol' => [
                'type' => 'INT',
            ],
            'RLPR_FK_permission' => [
                'type' => 'INT',
            ],
            'RLPR_date_create' => [
                'type' => 'DATE',
            ],
            'RLPR_date_update' => [
                'type' => 'DATE',
            ],
            'RLPR_user_create' => [
                'type' => 'INT',
            ],
            'RLPR_user_update' => [
                'type' => 'INT',
            ]
        ]);
        $this->forge->addKey('RLPR_PK',true);
        $this->forge->createTable('rolespermissions');
        $this->forge->addForeignKey('RLPR_FK_permission', 'permissions', 'PRMS_PK');
        $this->forge->addForeignKey('RLPR_FK_rol', 'roles', 'ROLE_PK');


    }

    public function down()
    {
        //
        $this->forge->DropTable('users');
    }
}

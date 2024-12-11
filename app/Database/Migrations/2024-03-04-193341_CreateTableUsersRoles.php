<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsersRoles extends Migration
{
    public function up()
    {
        // crear tabla usersroles
        $this->forge->addField([
            'USRL_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'USRL_FK_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'USRL_FK_rol' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        
        $this->forge->addPrimaryKey('USRL_PK');
        $this->forge->addKey('USRL_FK_rol',FALSE);
        $this->forge->addKey('USRL_FK_user',FALSE);
        $this->forge->createTable('usersroles');
        $this->forge->addForeignKey('USRL_FK_user', 'users', 'USER_PK','CASCADE','CASCADE','FK_users_roles');
        $this->forge->addForeignKey('USRL_FK_rol', 'roles', 'ROLE_PK','CASCADE','CASCADE','FK_roles_users');
        $this->forge->processIndexes('usersroles');
    }

    public function down()
    {
        //
        $this->forge->DropTable('usersroles');
    }
}

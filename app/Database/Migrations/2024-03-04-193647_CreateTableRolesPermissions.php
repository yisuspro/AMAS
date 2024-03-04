<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRolesPermissions extends Migration
{
    public function up()
    {
         // crear tabla roles_permissions
         $this->forge->addField([
            'RLPR_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'RLPR_FK_rol' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,                
            ],
            'RLPR_FK_permission' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
        $this->forge->addPrimaryKey('RLPR_PK');
        $this->forge->addKey('RLPR_FK_rol',FALSE);
        $this->forge->addKey('RLPR_FK_permission',FALSE);
        $this->forge->createTable('rolespermissions');
        $this->forge->addForeignKey('RLPR_FK_permission', 'permissions', 'PRMS_PK','CASCADE','CASCADE','FK_per_roles');
        $this->forge->addForeignKey('RLPR_FK_rol', 'roles', 'ROLE_PK','CASCADE','CASCADE','FK_roles_per');
        $this->forge->processIndexes('rolespermissions');

    }

    public function down()
    {
        $this->forge->DropTable('rolespermissions');
    }
}

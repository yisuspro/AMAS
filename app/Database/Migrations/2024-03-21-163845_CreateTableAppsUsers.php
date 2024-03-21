<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableAppsUsers extends Migration
{
    public function up()
    {
        // crear tabla acciones
        $this->forge->addField([
            'APUS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'APUS_FK_app' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'APUS_FK_users' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'APUS_state' => [
                'type' => 'INT',
            ],
            'APUS_confidentiality' => [
                'type' => 'BINARY',
            ],
            'APUS_date_validity' => [
                'type' => 'DATE',
            ],
            
        ]);
        $this->forge->addPrimaryKey('APUS_PK');
        $this->forge->addKey('APUS_FK_app',false);  
        $this->forge->addKey('APUS_FK_users',false);  
        $this->forge->createTable('appsusers');
        $this->forge->addForeignKey('APUS_FK_app', 'apps', 'APPS_PK','cascade','cascade','FK_apps_users');
        $this->forge->addForeignKey('APUS_FK_users', 'usersauditory', 'USDT_PK','cascade','cascade','FK_users_apps');
    }

    public function down()
    {
        $this->forge->dropTable('appsusers');
    }
}

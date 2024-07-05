<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUsers extends Migration
{

    /***********************************************
     * autor: JESUS CASTELLANOA
     * FECHA:02/07/2024
     * MODIFICA: DANIELA SILVESTREW
     * FECHA: 04/07/2024
     * DOCUMENTACION
     * CREACION DE LAS TABLAS:
     * TABLA USUARIOS
     * 
     */
    public function up()
    {
        // crear tabla Usuarios
        $this->forge->addField([
            'USER_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
                'unique' => true,
            ],
            'USER_identification' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'USER_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'USER_username' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'USER_password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addPrimaryKey('USER_PK');
        $this->forge->addKey('USER_FK_state_user',false); 
        $this->forge->createTable('users');
        $this->forge->addForeignKey('USER_FK_state_user', 'statesusers', 'STTS_PK','cascade','cascade','FK_users_states');
        $this->forge->processIndexes('users');
    }

    public function down()
    {
        //
        $this->forge->DropTable('users');
       
    }
}

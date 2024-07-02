<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableStatesUsers extends Migration
{

    /***********************************************
     * autor: JESUS CASTELLANOA
     * FECHA:02/07/2024
     * MODIFICA: DANIELA SILVESTREW
     * FECHA: 02/07/2024
     * DOCUMENTACION
     * CREACION DE LAS TABLAS:
     * -TABLA ESTADO USUARIOS
     * -TABLA APLICACIONES
     * 
     */
    public function up()
    {
        //Crear tabla estado de usuarios
        $this->forge->addField([
            'STTS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'STTS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'STTS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ]
        ]);
        $this->forge->addPrimaryKey('STTS_PK');
        $this->forge->createTable('statesusers');
        $this->forge->processIndexes('statesusers');

         //Crear tabla aplicaciones
         $this->forge->addField([
            'APPS_PK' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
                'unsigned' => true,
            ],
            'APPS_name' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'APPS_description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ]
        ]);
        $this->forge->addPrimaryKey('APPS_PK');
        $this->forge->createTable('apps');
        $this->forge->processIndexes('apps');

    }

    public function down()
    {
        $this->forge->dropTable('statesusers');
        $this->forge->dropTable('apps');
    }
}

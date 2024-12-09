<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Roles extends Seeder
{
    public function run()
    {
        // Cargamos datos base de la tabla para roles
        $dataRoles = [
            ['ROLE_name' => 'SUPERADMIN', 'ROLE_description' => 'super administrador', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1, "ROLE_state" => 1],
            ['ROLE_name' => 'USUARIOS', 'ROLE_description' => 'registro de usuarios', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1, "ROLE_state" => 1],
            ['ROLE_name' => 'CRUZES', 'ROLE_description' => 'registro de cruzes', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1, "ROLE_state" => 1],
            ['ROLE_name' => 'ADMIN', 'ROLE_description' => 'registro casos herramientas', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1, "ROLE_state" => 1],
            ['ROLE_name' => 'VALORACION 1448', 'ROLE_description' => 'Ajustes para 1448', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1, "ROLE_state" => 1],

        ];
        $this->db->table('roles')->insertBatch($dataRoles);

        // Cargamos datos base de la tabla para permisos
        $dataPermissions = [
            ['PRMS_name' => 'Consulta usuario', 'PRMS_description' => 'Consulta usuario', 'PRMS_system_name' => 'C_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Editar usuarios', 'PRMS_description' => 'Editar usuarios', 'PRMS_system_name' => 'E_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Inactivar usuarios', 'PRMS_description' => 'Inactivar usuarios', 'PRMS_system_name' => 'I_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Crear usuarios', 'PRMS_description' => 'Crear usuarios', 'PRMS_system_name' => 'CR_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Consulta roles', 'PRMS_description' => 'Consulta roles', 'PRMS_system_name' => 'C_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Editar roles', 'PRMS_description' => 'Editar roles', 'PRMS_system_name' => 'E_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Inactivar roles', 'PRMS_description' => 'Inactivar roles', 'PRMS_system_name' => 'I_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Crear roles', 'PRMS_description' => 'Crear roles', 'PRMS_system_name' => 'CR_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Asignar roles', 'PRMS_description' => 'Asignar roles', 'PRMS_system_name' => 'A_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Consulta permisos', 'PRMS_description' => 'Consulta permisos', 'PRMS_system_name' => 'C_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Editar permisos', 'PRMS_description' => 'Editar permisos', 'PRMS_system_name' => 'E_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Inactivar permisos', 'PRMS_description' => 'Inactivar permisos', 'PRMS_system_name' => 'I_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Crear permisos', 'PRMS_description' => 'Crear permisos', 'PRMS_system_name' => 'CR_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Asignar permisos', 'PRMS_description' => 'Asignar permisos', 'PRMS_system_name' => 'A_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'VERIFICACION_CRUCES', 'PRMS_description' => 'Descripción cruces realizados', 'PRMS_system_name' => 'VER_CRUCE', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Consultar usuarios apps', 'PRMS_description' => 'Permite consultar usuarios en varias aplicaciones', 'PRMS_system_name' => 'C_USERS_APP', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Registro poblacionales', 'PRMS_description' => 'Modulo de control para registros poblacionales', 'PRMS_system_name' => 'REG_POBLA', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],
            ['PRMS_name' => 'Migrar censo registro poblacional', 'PRMS_description' => 'Permiso para migrar censos', 'PRMS_system_name' => 'M_CEN_REG_POBLA', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1,"PRMS_state" => 1],

        ];
        $this->db->table('permissions')->insertBatch($dataPermissions);

        // Cargamos datos base de la tabla para permisos que pertenecen al rol 1
        $dataRolesPermissions = [
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 1, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 2, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 3, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 4, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 5, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 6, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 7, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 8, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 9, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 10, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 11, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 12, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 13, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 14, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 15, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 16, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 17, 'RLPR_FK_rol' => 1],
            ['RLPR_date_create' => date('Y-m-d H:i:s'), 'RLPR_date_update' => date('Y-m-d H:i:s'), 'RLPR_user_create' => 1, 'RLPR_user_update' => 1, 'RLPR_FK_permission' => 18, 'RLPR_FK_rol' => 1],
        ];
        $this->db->table('rolespermissions')->insertBatch($dataRolesPermissions);

        // Cargamos datos base de la tabla de usuario
        $dataUsers = [
            [ 'USER_name'=>'admin','USER_username' => 'administrador','USER_password' => password_hash('admin123', PASSWORD_DEFAULT), 'USER_date_create' => date('Y-m-d H:i:s'),'USER_date_update' => date('Y-m-d H:i:s'),'USER_FK_state_user' => 1],

        ];
        $this->db->table('users')->insertBatch($dataUsers);

        // Cargamos datos base de la tabla de roles para le usuario
        $dataUsersRoles = [
            [ 'USRL_FK_user'=> 1,'USRL_FK_rol' => 1,'USRL_date_create' => date('Y-m-d H:i:s') , 'USRL_date_update' => date('Y-m-d H:i:s'),'USRL_user_create' => 1,'USRL_user_update' => 1],

        ];
        $this->db->table('usersroles')->insertBatch($dataUsersRoles);
    }
}

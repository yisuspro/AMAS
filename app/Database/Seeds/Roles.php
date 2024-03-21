<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Roles extends Seeder
{
    public function run()
    {
        // cargamos datos base de la tabla para roles
        $dataRoles = [
            ['ROLE_name' => 'SUPERADMIN', 'ROLE_description' => 'super administrador', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1],
            ['ROLE_name' => 'USUARIOS', 'ROLE_description' => 'registro de usuarios', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1],
            ['ROLE_name' => 'CRUZES', 'ROLE_description' => 'registro de cruzes', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1],
            ['ROLE_name' => 'ADMIN', 'ROLE_description' => 'registro casos herramientas', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1],
            ['ROLE_name' => 'VALORACION 1448', 'ROLE_description' => 'Ajustes para 1448', 'ROLE_date_create' => date('Y-m-d H:i:s'), 'ROLE_date_update' => date('Y-m-d H:i:s'), 'ROLE_FK_user_create' => 1, 'ROLE_FK_user_update' => 1],

        ];
        $this->db->table('roles')->insertBatch($dataRoles);

        // cargamos datos base de la tabla para permisos
        $dataPermissions = [
            ['PRMS_name' => 'consulta usuario', 'PRMS_description' => 'consulta usuario', 'PRMS_system_name' => 'C_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'editar usuarios', 'PRMS_description' => 'editar usuarios', 'PRMS_system_name' => 'E_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'inactivar usuarios', 'PRMS_description' => 'inactivar usuarios', 'PRMS_system_name' => 'I_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'crear usuarios', 'PRMS_description' => 'crear usuarios', 'PRMS_system_name' => 'CR_USERS', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'consulta roles', 'PRMS_description' => 'consulta roles', 'PRMS_system_name' => 'C_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'editar roles', 'PRMS_description' => 'editar roles', 'PRMS_system_name' => 'E_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'inactivar roles', 'PRMS_description' => 'inactivar roles', 'PRMS_system_name' => 'I_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'crear roles', 'PRMS_description' => 'crear roles', 'PRMS_system_name' => 'CR_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'asignar roles', 'PRMS_description' => 'asignar roles', 'PRMS_system_name' => 'A_ROLES', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'consulta permisos', 'PRMS_description' => 'consulta permisos', 'PRMS_system_name' => 'C_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'editar permisos', 'PRMS_description' => 'editar permisos', 'PRMS_system_name' => 'E_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'inactivar permisos', 'PRMS_description' => 'inactivar permisos', 'PRMS_system_name' => 'I_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'crear permisos', 'PRMS_description' => 'crear permisos', 'PRMS_system_name' => 'CR_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],
            ['PRMS_name' => 'asignar permisos', 'PRMS_description' => 'asignar permisos', 'PRMS_system_name' => 'A_PERMI', 'PRMS_date_create' => date('Y-m-d H:i:s'), 'PRMS_date_update' => date('Y-m-d H:i:s'), 'PRMS_user_create' => 1, 'PRMS_user_update' => 1],

        ];
        $this->db->table('permissions')->insertBatch($dataPermissions);

        // cargamos datos base de la tabla para permisos que pertenecen al rol 1
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
        ];
        $this->db->table('rolespermissions')->insertBatch($dataRolesPermissions);

        // cargamos datos base de la tabla de usaurio
        $dataUsers = [
            [ 'USER_name'=>'admin','USER_username' => 'administrador','USER_password' => 'admin123' , 'USER_date_create' => date('Y-m-d H:i:s'),'USER_date_update' => date('Y-m-d H:i:s'),'USER_FK_state_user' => 1],

        ];
        $this->db->table('users')->insertBatch($dataUsers);

        // cargamos datos base de la tabla de roles para le usaurio
        $dataUsersRoles = [
            [ 'USRL_FK_user'=> 1,'USRL_FK_rol' => 1,'USRL_date_create' => date('Y-m-d H:i:s') , 'USRL_date_update' => date('Y-m-d H:i:s'),'USRL_user_create' => 1,'USRL_user_update' => 1],

        ];
        $this->db->table('usersroles')->insertBatch($dataUsersRoles);
    }
}

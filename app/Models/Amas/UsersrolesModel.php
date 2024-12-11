<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\UsersrolesEntity;

class UsersrolesModel extends Model
{
    protected $table = 'usersroles';
    protected $primaryKey = 'USRL_PK';
    protected $returnType   = UsersrolesEntity::class;

    protected $allowedFields = [
        'USRL_FK_user',
        'USRL_FK_rol',
        'USRL_date_create',
        'USRL_date_update',
        'USRL_user_create',
        'USRL_user_update',
        'USRL_state',
    ];

    protected $createdField  = 'USRL_date_create';
    protected $updatedField  = 'USRL_date_update';

    protected $useTimestamps = false;

    // List roles assigned to a user
    public function listUsersRoles($id)
    {
        $query = $this->db->table('roles R')
            ->select('R.ROLE_PK, R.ROLE_name, R.ROLE_description, UR.USRL_FK_user, UR.USRL_state')
            ->join('(SELECT * FROM usersroles WHERE USRL_FK_user = ' . $id . ') AS UR', 'R.ROLE_PK = UR.USRL_FK_rol', 'left')
            ->where('R.ROLE_state', 1)
            ->get();

        return $query ? $query : false;
    }

    // Validate if a specific user-role relation exists
    public function validateUsersRolesId($USER_PK, $ROLE_PK)
    {
        return $this->where('USRL_FK_rol', $ROLE_PK)
                    ->where('USRL_FK_user', $USER_PK)
                    ->first() ?: false;
    }

    // Toggle the state (active/inactive) of a user-role relation
    public function updateStateUsersRolesId($USRL_PK, $USER_PK)
    {
        // Get the current state
        $currentState = $this->where('USRL_PK', $USRL_PK)->first()['USRL_state'];

        // Prepare new state
        $newState = ($currentState == 1) ? 0 : 1;
        $query = $this->set('USRL_state', $newState)
                      ->set('USRL_date_update', date('Y-m-d H:i:s'))
                      ->set('USRL_user_update', $USER_PK)
                      ->where('USRL_PK', $USRL_PK)
                      ->update();

        return $query ? true : false;
    }

    public function addStateUsersRolesId($data)
    {
        return $this->insert($data) ? true : false;
    }

    // Get all permissions assigned to a user through their roles
    public function validateRolesUser($USER_PK)
    {
        $query = $this->db->table('usersroles US')
            ->distinct()
            ->select('PR.PRMS_system_name')
            ->join('roles RO', 'RO.ROLE_PK = US.USRL_FK_rol')
            ->join('rolespermissions RP', 'RO.ROLE_PK = RP.RLPR_FK_rol')
            ->join('permissions PR', 'RP.RLPR_FK_permission = PR.PRMS_PK')
            ->where('US.USRL_FK_user', $USER_PK)
            ->where('RO.ROLE_state', 1)
            ->where('PR.PRMS_state', 1)
            ->where('US.USRL_state', 1)
            ->where('RP.RLPR_state', 1)
            ->get();

        if ($query) {
            return array_map(function ($row) {
                return $row->PRMS_system_name;
            }, $query->getResult());
        }

        return false;
    }
}

<?php 

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\UsersrolesEntity;

class UsersrolesModel extends Model
{
    protected $table        = 'usersroles';
    protected $primaryKey   = 'USRL_PK';
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

    protected $createdField = 'USRL_date_create';
    protected $updatedField = 'USRL_date_update';

    protected $useTimestamps = true;

    
    /**
     * The function `listUsersRoles` retrieves a list of roles assigned to a specific user from the
     * database.
     * 
     * @param id The `listUsersRoles` function takes a user ID as a parameter. It retrieves a list of
     * roles associated with that user from the database. The function constructs a query to select
     * role information from the `roles` table and user-role mapping from the `usersroles` table.
     * 
     * @return The `listUsersRoles` function is returning a list of roles for a specific user
     * identified by the `` parameter. The function queries the database to select the role primary
     * key, name, description, user foreign key, and state from the 'roles' table, joining it with a
     * subquery that filters roles based on the user ID. The function then filters the roles based on
     * the 'ROLE
     */
    public function listUsersRoles($id)
    {
        return $this->db->table('roles R')
        ->select('R.ROLE_PK, R.ROLE_name, R.ROLE_description, UR.USRL_FK_user, UR.USRL_state')
        ->join('(SELECT * FROM usersroles WHERE USRL_FK_user = ' . $id . ') AS UR', 'R.ROLE_PK = UR.USRL_FK_rol', 'left')
        ->where('R.ROLE_state', 1)
        ->get(); // Convert to array
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
        // Get the current state and prepare new state
        $currentState = $this->where('USRL_PK', $USRL_PK)->first();
       // Toggle the state of a role-permission association
        $newState = ($currentState->USRL_state == 1) ? 0 : 1;

        // Update state and other fields
        $data = [
            'USRL_state' => $newState,
            'USRL_date_update' => date('Y-m-d H:i:s'),
            'USRL_user_update' => $USER_PK
        ];

        return $this->update($USRL_PK, $data);
    }

    public function addStateUsersRolesId($data)
    {
        return $this->insert($data);
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

<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\RolespermissionsEntity;

class RolespermissionsModel extends Model
{
    protected $table        = 'rolespermissions';
    protected $primaryKey   = 'RLPR_PK';
    protected $returnType   = RolespermissionsEntity::class;

    protected $allowedFields = [
        'RLPR_date_create',
        'RLPR_date_update',
        'RLPR_user_create',
        'RLPR_user_update',
        'RLPR_FK_permission',
        'RLPR_FK_rol',
        'RLPR_state',
    ];

    protected $createdField  = 'RLPR_date_create';
    protected $updatedField  = 'RLPR_date_update';

    protected $useTimestamps = true;

    /**
     * This PHP function retrieves permissions for a given role ID from a database table.
     * 
     * @param rolId The `listRolesPermissions` function you provided is a PHP function that retrieves
     * permissions for a given role ID from a database table. The function takes a role ID as a
     * parameter and returns the permissions associated with that role.
     * 
     * @return The function `listRolesPermissions` returns the permissions associated with a given role
     * ID. It queries the database to retrieve the permissions that are linked to the specified role
     * ID. The result will include the permission ID, name, description, role ID, and state of the
     * permission-role relationship. If the query is successful, it will return the result set;
     * otherwise, it will return false.
     */
    public function listRolesPermissions($rolId)
    {
        $query = $this->db->table('permissions P')
            ->select('P.PRMS_PK, P.PRMS_name, P.PRMS_description, RP.RLPR_FK_rol, RP.RLPR_state')
            ->join('(SELECT * FROM rolespermissions WHERE RLPR_FK_rol = '.$rolId.') AS RP', 'P.PRMS_PK = RP.RLPR_FK_permission', 'left')
            ->where('P.PRMS_state',1)
            ->get();

            

        return $query ? $query : false;
    }


    


    /**
     * The function `validateRolesPermissionsId` checks if a role has a specific permission assigned.
     * 
     * @param rol The `rol` parameter in the `validateRolesPermissionsId` function seems to represent a
     * role identifier. This function is likely used to validate if a specific role has a particular
     * permission based on the provided role and permission identifiers.
     * @param permission The `validateRolesPermissionsId` function you provided seems to be a method
     * that checks if a specific role and permission combination exists in a database table. The
     * parameters `` and `` are used to specify the role and permission IDs that you
     * want to validate.
     * 
     * @return The `validateRolesPermissionsId` function is returning the result of a query that checks
     * if a specific role and permission combination exists in the database. If a record matching the
     * provided role and permission is found, the function will return that record. If no matching
     * record is found, it will return `false`.
     */
    public function validateRolesPermissionsId($rol, $permission)
    {
        $query = $this->where('RLPR_FK_permission', $permission)
            ->where('RLPR_FK_rol', $rol)
            ->first();

        return $query ?: false;
    }

    /**
     * This PHP function updates the state of a role-permission association based on the current state
     * and a given ID and user.
     * 
     * @param id The `id` parameter in the `updateStateRolesPermissionsId` function represents the
     * primary key value of the role-permission association that you want to update. It is used to
     * identify the specific record in the database that you want to toggle the state for.
     * @param user The `updateStateRolesPermissionsId` function takes two parameters:
     * 
     * @return a boolean value - `true` if the update operation was successful, and `false` if it was
     * not successful.
     */
    public function updateStateRolesPermissionsId($id, $user)
    {
        // Toggle the state of a role-permission association
        $currentRecord = $this->where('RLPR_PK', $id)->first();
    
        if (!$currentRecord) {
            return false;
        }
    
        // Determine the new state (0 if current is 1, 1 if current is 0)
        $newState = ($currentRecord->RLPR_state == 1) ? 0 : 1;
    
        $updated = $this->set([
                'RLPR_state'        => $newState,
                'RLPR_date_update'  => date('Y-m-d H:i:s'),
                'RLPR_user_update'  => $user
            ])
            ->where('RLPR_PK', $id)
            ->update();
    
        return $updated ? true : false;
    }

    /**
     * This PHP function adds state roles permissions ID to the database and returns true if
     * successful.
     * 
     * @param data The `addStateRolesPermissionsId` function appears to be a method that adds state
     * roles permissions ID to a database table. The function takes a single parameter ``, which
     * likely contains the data to be inserted into the database table.
     * 
     * @return The function `addStateRolesPermissionsId` is returning a boolean value. It returns
     * `true` if the `insert` method is successful, and `false` otherwise.
     */
    public function addStateRolesPermissionsId($data)
    {
        return $this->save($data);
    }

    /**
     * This PHP function validates permissions for a given set of roles by querying the database and
     * returning an array of permission system names if found.
     * 
     * @param roles The `validatePermissionsRole` function you provided seems to be querying the
     * database to retrieve permissions based on the roles provided. It selects the system names of
     * permissions associated with the given roles.
     * 
     * @return An array of permissions associated with the roles provided in the input parameter
     * `` is being returned by this function. If no permissions are found for the given roles, it
     * will return `false`.
     */
    public function validatePermissionsRole($roles)
    {
        $query = $this->db->table('rolespermissions RP')
            ->select('P.PRMS_system_name')
            ->join('permissions P', 'P.PRMS_PK = RP.RLPR_FK_permission', 'left')
            ->whereIn('RP.RLPR_FK_rol', $roles)
            ->where('RP.RLPR_state', 1)
            ->get();

        $permissions = [];
        if ($query) {
            foreach ($query->getResult() as $row) {
                $permissions[] = $row->PRMS_system_name;
            }
            return $permissions;
        }

        return false;
    }
}

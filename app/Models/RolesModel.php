<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'ROLE_PK';

    protected $allowedFields = [
        'ROLE_name',
        'ROLE_description',
        'ROLE_date_create',
        'ROLE_date_update',
        'ROLE_FK_user_create',
        'ROLE_FK_user_update',
        'ROLE_state'
    ];

    protected $useTimestamps = false;

    /**
     * The listRoles function returns all roles from the database.
     * 
     * @return The `listRoles` function is returning all roles found in the database.
     */
    public function listRoles()
    {
        return $this->findAll();
    }
    
    /**
     * The function `insertRoles` checks if a role name already exists before inserting data into a
     * database table.
     * 
     * @param data The `insertRoles` function takes an array `` as a parameter. This array likely
     * contains information related to a role that needs to be inserted into a database. The function
     * first checks if the role name already exists by calling the `roleNameExists` method with the
     * role name extracted from the
     * 
     * @return If the role name does not exist, the function will return the result of the `insert`
     * method with the provided data. If the role name already exists, the function will return `false`
     * or throw an exception.
     */
    public function insertRoles($data)
    {
        // Check if the role name exists
        if ($this->roleNameExists($data['ROLE_name'])) {
            return false; // or throw an exception
        }
        return $this->insert($data);
    }
    
    /**
     * The function "viewRoles" retrieves role details by the primary key (ROLE_PK).
     * 
     * @param roleId The `viewRoles` function is designed to retrieve role details based on the primary
     * key `ROLE_PK`. The function takes a parameter `` which represents the primary key value
     * of the role that you want to retrieve. When you call this function, you should pass the primary
     * key value of the role
     * 
     * @return The `viewRoles` function is returning the role details based on the primary key
     * `` by using the `find` method.
     */
    public function viewRoles($roleId)
    {
        return $this->find($roleId);
    }
    
    /**
     * The function "validateRolesId" checks if a role ID exists in the database.
     * 
     * @param roleId The `validateRolesId` function takes a parameter called ``, which is used
     * to find a record in the database based on the provided role ID. If a record with the specified
     * role ID is found, the function will return that record. Otherwise, it will return `false`.
     * 
     * @return The `validateRolesId` function is returning the result of the `find` method called on
     * `` with the `` parameter passed to it. If a result is found, it will return that
     * result. If no result is found (i.e., the result is falsy), it will return `false`.
     */
    public function validateRolesId($roleId)
    {
        return $this->find($roleId) ?? false;
    }
    
    /**
     * This PHP function updates a role based on the provided data if the role exists.
     * 
     * @param data The `updateRoles` function takes an array `` as a parameter. This array
     * typically contains information related to a role that needs to be updated. The function first
     * tries to find the role based on the `ROLE_PK` key in the `` array. If the role is found,
     * 
     * @return The `updateRoles` function is returning a boolean value. If the role with the specified
     * primary key (`ROLE_PK`) is found and successfully updated, it will return `true`. Otherwise, it
     * will return `false`.
     */
    public function updateRoles($data)
    {
        $role = $this->find($data['ROLE_PK']);
        if ($role) {
            $this->update($data['ROLE_PK'], $data);
            return true;
        }
        return false;
    }
    
    /**
     * The function checks if a role name already exists in the database table.
     * 
     * @param roleName The `roleName` parameter is a string representing the name of a role that you
     * want to check for existence in the database. The `roleNameExists` function checks if a role with
     * the specified name already exists in the database and returns a boolean value indicating whether
     * it exists or not.
     * 
     * @return The function `roleNameExists` is returning a boolean value - `true` if a record with the
     * specified role name exists in the database table, and `false` if it does not exist.
     */
    public function roleNameExists($roleName)
    {
        return $this->where('ROLE_name', $roleName)->first() ? true : false;
    }
}

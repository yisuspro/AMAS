<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\PermissionsEntity;

class PermissionsModel extends Model
{
    protected $table        = 'permissions';
    protected $primaryKey   = 'PRMS_PK';
    protected $returnType   = PermissionsEntity::class;

    protected $allowedFields = [
        'PRMS_name',
        'PRMS_description',
        'PRMS_system_name',
        'PRMS_date_create',
        'PRMS_date_update',
        'PRMS_user_create',
        'PRMS_user_update',
        'PRMS_state'
    ];


    protected $createdField  = 'PRMS_date_create';
    protected $updatedField  = 'PRMS_date_update';

    protected $useTimestamps = false;
    // Método para insertar un usuario encriptando la contraseña


    /**
     * The listPermissions function retrieves all permissions from the database.
     * 
     * @return The `listPermissions` function is returning all columns from the database table without
     * any specific conditions or filters.
     */
    public function listPermissions()
    {
        return $this->select('*')->get();
    }
    
    /**
     * The function `validatePermissions` checks if a record with a specific system name exists in the
     * database table and returns true if it does, otherwise false.
     * 
     * @param data The `validatePermissions` function takes a parameter named ``, which is used to
     * check if a record exists in the database where the column `PRMS_system_name` matches the value
     * of ``. If a record is found, the function returns `true`, indicating that the permission is
     * valid.
     * 
     * @return The function `validatePermissions` is returning a boolean value. It returns `true` if
     * there is a record in the database table where the column `PRMS_system_name` matches the input
     * ``, and `false` otherwise.
     */
    public function validatePermissions($data)
    {
        return $this->where('PRMS_system_name', $data)->first() ? true : false;
    }
    
    /**
     * The function `validatePermissionsId` checks if a record with the specified ID exists in the
     * database table and returns it if found, otherwise returns false.
     * 
     * @param data The `validatePermissionsId` function takes a parameter named ``, which is used
     * to query the database for a record where the `PRMS_PK` column matches the value of ``. If a
     * record is found, it is returned. Otherwise, it returns `false`.
     * 
     * @return The `validatePermissionsId` function is returning the first row from the database where
     * the 'PRMS_PK' column matches the provided ``. If a matching row is found, it will be
     * returned. If no matching row is found, it will return `false`.
     */
    public function validatePermissionsId($data)
    {
        return $this->where('PRMS_PK', $data)->first() ?? false;
    }
    
    /**
     * The insertPermissions function inserts data into a database using the insert method.
     * 
     * @param data The `insertPermissions` function is a method that takes a single parameter ``.
     * This function is likely used to insert permissions data into a database table. The function
     * simply calls another method `insert` with the provided `` and returns the result.
     * 
     * @return The `insertPermissions` function is returning the result of calling the `insert` method
     * with the `` parameter.
     */
    public function insertPermissions($data)
    {
        return $this->insert($data);
    }
    
    /**
     * The viewPermissions function retrieves data based on a specified PRMS_PK value.
     * 
     * @param data The `data` parameter in the `viewPermissions` function is used to specify the value
     * of the `PRMS_PK` column that you want to retrieve from the database. This function retrieves the
     * record from the database where the `PRMS_PK` column matches the provided `data` value.
     * 
     * @return The `viewPermissions` function is returning the result of a database query that fetches
     * a record based on the value of the `PRMS_PK` column matching the provided ``. If a record
     * is found, it will be returned. If no record is found, it will return `false`.
     */
    public function viewPermissions($data)
    {
        return $this->where('PRMS_PK', $data)->get() ?? false;
    }
    
    /**
     * The function `updatePermissions` updates permissions in a database table based on the provided
     * data.
     * 
     * @param data The `updatePermissions` function takes an array of data as a parameter. This data
     * array should contain the values needed to update permissions in the database. The function then
     * sets the data, specifies the condition for the update using the 'PRMS_PK' key from the data
     * array, and performs the update
     * 
     * @return The function `updatePermissions` is returning a boolean value. It returns `true` if the
     * update operation was successful, and `false` if it was not successful.
     */
    public function updatePermissions($data)
    {
        return $this->set($data)->where('PRMS_PK', $data['PRMS_PK'])->update() ? true : false;
    }
    
}

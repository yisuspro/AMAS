<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\UsersEntity;

class UsersModel extends Model
{
    protected $table        = 'users';
    protected $primaryKey   = 'USER_PK';
    protected $returnType   = UsersEntity::class;

    protected $allowedFields = [
        'USER_name',
        'USER_username',
        'USER_identification',
        'USER_password',
        'USER_date_create',
        'USER_date_update',
        'USER_FK_user_create',
        'USER_FK_user_update',
        'USER_FK_state_user',
        'USER_reset_password',
        'USER_email',
        'USER_address_ip',
    ];

    protected $createdField  = 'USER_FK_user_create';
    protected $updatedField  = 'USER_FK_user_update';

    protected $useTimestamps = true;

    /**
     * The insertUser function hashes the user's password and standardizes the user's name before
     * inserting the data into the database.
     * 
     * @param data The `insertUser` function takes an array of data as a parameter. This data typically
     * contains information about a user that needs to be inserted into a database. The function first
     * hashes the user's password using the `password_hash` function with the `PASSWORD_DEFAULT`
     * algorithm. It then standardizes the
     * 
     * @return The `insertUser` function is returning the result of calling the `insert` method with
     * the modified `` array. The function first hashes the user's password using `password_hash`
     * and then standardizes the user's name to uppercase before inserting the data into the database.
     */
    public function insertUser($data)
    {
        $data['USER_password'] = password_hash($data['USER_password'], PASSWORD_DEFAULT);
        $data['USER_name'] = strtoupper($data['USER_name']);  // Standardize user name

        return $this->insert($data);
    }

    /**
     * The function `validateUser` checks if the provided username and password match a user in the
     * database and returns the user if the credentials are valid.
     * 
     * @param data The `validateUser` function you provided is used to validate a user based on the
     * provided data. It checks if a user with the given username exists and if the password matches
     * the hashed password stored in the database.
     * 
     * @return If the user with the provided username exists and the password matches the hashed
     * password stored in the database, the function will return the user data. Otherwise, it will
     * return false.
     */
    public function validateUser($data)
    {
        $user = $this->where('USER_username', $data['USER_username'])->first();
        
        if ($user && password_verify($data['USER_password'], $user->USER_password)) {
            return $user;
        }

        return false;
    }

    /**
     * The function `validateIPUser` checks if the provided IP address matches the stored IP address
     * for a user identified by their primary key.
     * 
     * @param USER_PK The `USER_PK` parameter is likely a unique identifier for a user in the database.
     * It is used to retrieve a specific user record from the database table.
     * @param USER_address_ip The `validateIPUser` function you provided is used to validate whether
     * the IP address provided matches the IP address associated with a user in the database.
     * 
     * @return The `validateIPUser` function is returning `true` if either the user's IP address is
     * empty or matches the provided ``. Otherwise, it returns `false`.
     */
    public function validateIPUser($USER_PK, $USER_address_ip)
    {
        $user = $this->where('USER_PK', $USER_PK)->first();

        // Allow if no IP is set
        if (empty($user->USER_address_ip) || $user->USER_address_ip === $USER_address_ip) {
            return true;
        }

        return false;
    }

    /**
     * The function `validateUserDoc` checks if a user identification data already exists in the
     * database.
     * 
     * @param data The `validateUserDoc` function appears to be a method that checks if a user
     * identification document exists in the database. The parameter `` is likely the user
     * identification data that is being passed to the function for validation. This function queries
     * the database to check if a record with the provided user identification
     * 
     * @return The `validateUserDoc` function is returning the result of a query that checks if there
     * is no record in the database where the 'USER_identification' column matches the provided
     * ``. If no record is found, it will return `true`, indicating that the user document is
     * valid.
     */
    public function validateUserDoc($data)
    {
        return !$this->where('USER_identification', $data)->first();
    }

    /**
     * The function `validateUserId` checks if a user ID exists in the database table and returns the
     * corresponding record if found, or false if not found.
     * 
     * @param data The `validateUserId` function takes a parameter ``, which is used to query the
     * database for a user with the `USER_PK` matching the provided data. If a user is found, the
     * function returns the user data; otherwise, it returns `false`.
     * 
     * @return The `validateUserId` function is returning the first record from the database where the
     * `USER_PK` column matches the provided ``. If a record is found, it will be returned. If no
     * record is found, it will return `false`.
     */
    public function validateUserId($data)
    {
        return $this->where('USER_PK', $data)->first() ?: false;
    }

    /**
     * The function `viewUsers` retrieves a user record based on the provided primary key or returns
     * false if not found.
     * 
     * @param data The `viewUsers` function takes a parameter ``, which is used to filter the
     * query based on the `USER_PK` column. The function will return the first row that matches the
     * `USER_PK` value provided in the `` parameter. If no matching row is found, it will
     * 
     * @return The `viewUsers` function is returning the first user record where the `USER_PK` column
     * matches the provided ``. If a matching user record is found, it will be returned.
     * Otherwise, it will return `false`.
     */
    public function viewUsers($data)
    {
        return $this->where('USER_PK', $data)->first() ?: false;
    }

    /**
     * The listUsers function retrieves all users along with their associated states from the database.
     * 
     * @return The `listUsers()` function is returning a result set of all users along with their
     * associated states from the database. The function is selecting all columns (`*`) from the
     * `users` table and joining it with the `statesusers` table on the condition `statesusers.STTS_PK
     * = users.USER_FK_state_user` using a left join. The final result set is retrieved using the `get
     */
    public function listUsers()
    {
        return $this->select('*')
            ->join('statesusers', 'statesusers.STTS_PK = users.USER_FK_state_user', 'left')
            ->get();
    }

    /**
     * The function `updateUsers` updates a user record in a database based on the provided data.
     * 
     * @param data The `updateUsers` function takes an array `` as a parameter. This array should
     * contain the following key-value pairs:
     * 
     * @return The `updateUsers` function is returning the result of calling the `update` method with
     * the `USER_PK` key from the `` array and the entire `` array as arguments.
     */
    public function updateUsers($data)
    {
        return $this->update($data->USER_PK, $data) ?: false;
    }

    /**
     * The function `updatePasswordUsers` updates the password of a user by hashing it using the
     * `password_hash` function in PHP.
     * 
     * @param data The `updatePasswordUsers` function seems to be updating the password of a user by
     * hashing the new password using `password_hash` function. The function then updates the user data
     * in the database using the `update` method.
     * 
     * @return The `updatePasswordUsers` function is returning the result of the `update` method with
     * the updated password data. If the update is successful, it will return the updated data. If the
     * update fails, it will return `false`.
     */
    public function updatePasswordUsers($data)
    {  
        $data->USER_password = password_hash($data->USER_password, PASSWORD_DEFAULT);
        return $this->update($data->USER_PK, $data) ?: false;
    }

   /**
    * The function `validatePasswords` in PHP checks if a given password matches a hashed password
    * stored in a database.
    * 
    * @param password The `password` parameter is the password that a user is trying to validate.
    * @param passwordDataBase The `` parameter in the `validatePasswords` function is
    * likely the hashed password stored in the database. When a user tries to log in, their input
    * password is compared with the hashed password in the database using the `password_verify`
    * function to check if they match.
    * 
    * @return the result of the `password_verify` function, which checks if the provided password
    * matches the hashed password stored in the database. It will return `true` if the passwords match,
    * and `false` if they do not match.
    */
    public function validatePasswords($password, $passwordDataBase)
    {
        return password_verify($password, $passwordDataBase);
    }
}

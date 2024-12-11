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

    protected $useTimestamps = false;

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
        
        if ($user && password_verify($data['USER_password'], $user['USER_password'])) {
            return $user;
        }

        return false;
    }

    public function validateIPUser($USER_PK, $USER_address_ip)
    {
        $user = $this->where('USER_PK', $USER_PK)->first();

        // Allow if no IP is set
        if (empty($user['USER_address_ip']) || $user['USER_address_ip'] === $USER_address_ip) {
            return true;
        }

        return false;
    }

    public function validateUserDoc($data)
    {
        return !$this->where('USER_identification', $data)->first();
    }

    public function validateUserId($data)
    {
        return $this->where('USER_PK', $data)->first() ?: false;
    }

    public function viewUsers($data)
    {
        return $this->where('USER_PK', $data)->first() ?: false;
    }

    public function listUsers()
    {
        return $this->select('*')
            ->join('statesusers', 'statesusers.STTS_PK = users.USER_FK_state_user', 'left')
            ->get();
    }

    public function updateUsers($data)
    {
        return $this->update($data['USER_PK'], $data);
    }

    public function updatePasswordUsers($data)
    {
        $data['USER_password'] = password_hash($data['USER_password'], PASSWORD_DEFAULT);
        return $this->update($data['USER_PK'], $data);
    }

    public function validatePasswords($password, $passwordDataBase)
    {
        return password_verify($password, $passwordDataBase);
    }
}

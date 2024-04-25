<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'USER_PK';

    protected $allowedFields = [
        'USER_name',
        'USER_username',
        'USER_identification',
        'USER_password',
        'USER_date_create',
        'USER_date_update',
        'USER_FK_user_create',
        'USER_FK_user_update',
        'USER_FK_state_user'
    ];

    protected $useTimestamps = false;
    // Método para insertar un usuario encriptando la contraseña
    public function insertUser($data)
    {
        // Encriptar la contraseña antes de insertarla en la base de datos
        $data['USER_password'] = password_hash($data['USER_password'], PASSWORD_DEFAULT);
        $data['USER_name'] = strtoupper($data['USER_name']);

        // Insertar el usuario en la base de datos

        return $this->insert($data);
    }
    
    public function validateUser($data)
    {
        // Encriptar la contraseña antes de insertarla en la base de datos

        $query = $this->where('USER_username', $data['USER_username'])->first();
        if ($query) {
            if (password_verify($data['USER_password'], $query['USER_password'])) {
                return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function validateUserDoc($data)
    {
        // Encriptar la contraseña antes de insertarla en la base de datos

        $query = $this->where('USER_identification', $data)->first();
        if ($query) {
            return false;
        } else {
            return true;
        }
    }
    public function listUsers()
    {
        $query = $this->select('*')
            ->join('statesusers', 'statesusers.STTS_PK = users.USER_FK_state_user','left');
        return $query->get();
    }
}

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

        // Insertar el usuario en la base de datos
        return $this->insert($data);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class StatesUsersModel extends Model
{
    protected $table = 'statesusers';
    protected $primaryKey = 'STTS_PK';

    protected $allowedFields = [
        'STTS_name',
        'STTS_description'
    ];

    protected $useTimestamps = false;
    // Método para insertar un usuario encriptando la contraseña
    public function listStatesUsers($data)
    {
        // Encriptar la contraseña antes de insertarla en la base de datos
        $query = $this->select('*');
        return $query->get();
    }
}

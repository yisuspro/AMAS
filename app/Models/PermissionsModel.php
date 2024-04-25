<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionsModel extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'PRMS_PK';

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

    protected $useTimestamps = false;
    // Método para insertar un usuario encriptando la contraseña
    public function listPermissions()
    {
        // Encriptar la contraseña antes de insertarla en la base de datos
        $query = $this->select('*');
        return $query->get();
    }

    public function validatePermissions($data)
    {
        $query = $this->where('PRMS_system_name', $data)->first();
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


    public function validatePermissionsId($data)
    {
        $query = $this->where('PRMS_PK',$data)->first();
         if ($query) {
            return $query;
        } else {
            return false;
        }
    }


    public function insertPermissions($data)
    {
        return $this->insert($data);
        
    }

    public function viewPermissions($data)
    {
        $query = $this->where('PRMS_PK', $data)->get();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    
    public function updatePermissions($data)
    {
        $query= $this->set($data)
        ->where('PRMS_PK', $data['PRMS_PK']);
        if($query->update()){
            return true;
        }else{
            return false;
        }
        
    }
}

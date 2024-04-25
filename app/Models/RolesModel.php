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

    public function listRoles()
    {
        // Encriptar la contraseña antes de insertarla en la base de datos
        $query = $this->select('*');
        return $query->get();
    }

    

    public function insertRoles($data)
    {
        return $this->insert($data);
        
    }

    public function viewRoles($data)
    {
        $query = $this->where('ROLE_PK', $data)->get();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function validateRolesId($data)
    {
        $query = $this->where('ROLE_PK',$data)->first();
         if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function updateRoles($data)
    {
        $query= $this->set($data)
        ->where('ROLE_PK', $data['ROLE_PK']);
        if($query->update()){
            return true;
        }else{
            return false;
        }
        
    }
}

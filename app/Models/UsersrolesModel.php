<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersrolesModel extends Model
{
    protected $table = 'usersroles';
    protected $primaryKey = 'USRL_PK';

    protected $allowedFields = [
        'USRL_FK_user',
        'USRL_FK_rol',
        'USRL_date_create',
        'USRL_date_update',
        'USRL_user_create',
        'USRL_user_update',
        'USRL_state'
    ];

    protected $useTimestamps = false;

    public function listUsersRoles($id)
    {
        $query = $this->db->table('roles R')
            ->select('R.ROLE_PK, R.ROLE_name, R.ROLE_description, UR.USRL_FK_user, UR.USRL_state')
            ->join('(SELECT * FROM usersroles WHERE USRL_FK_user = ' . $id . ') AS UR', 'R.ROLE_PK = UR.USRL_FK_rol', 'left')
            ->get();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function validateUsersRolesId($USER_PK, $ROLE_PK)
    {
        $query = $this->where('USRL_FK_rol',$ROLE_PK)->where('USRL_FK_user',$USER_PK)->first();
         if ($query) {
            return $query;
        } else { 
            return false;
        }
    }

    public function updateStateUsersRolesId($USRL_PK,$USER_PK)
    {
         
        $query = $this->where('USRL_PK',$USRL_PK)->first();
        if($query['USRL_state'] == 1){
            $query= $this->set('USRL_state',0)
            ->set('USRL_date_update',date('Y-m-d H:i:s'))
            ->set('USRL_user_update',$USER_PK)
            ->where('USRL_PK', $USRL_PK);
            if($query->update()){
                return true;
            }else{
                return false;
            }
        }else{
            $query= $this->set('USRL_state',1)
            ->set('USRL_date_update',date('Y-m-d H:i:s'))
            ->set('USRL_user_update',$USER_PK)
            ->where('USRL_PK', $USRL_PK);
            if($query->update()){
                return true;
            }else{
                return false;
            }
        }
           
    }

    public function addStateUsersRolesId($data)
    {
        $result = $this->insert($data);
        if($result){
            return $result;

        }else{
            return false;
        }
    }
}

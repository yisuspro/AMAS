<?php

namespace App\Models;

use CodeIgniter\Model;

class RolespermissionsModel extends Model
{
    protected $table = 'rolespermissions';
    protected $primaryKey = 'RLPR_PK';

    protected $allowedFields = [
        
        'RLPR_date_create',
        'RLPR_date_update',
        'RLPR_user_create',
        'RLPR_user_update',
        'RLPR_FK_permission',
        'RLPR_FK_rol',
        'RLPR_state'
    ];

    protected $useTimestamps = false;
/*SELECT * FROM permissions P
JOIN rolespermissions RP on p.PRMS_PK = RP.RLPR_FK_permission;

SELECT P.PRMS_PK,P.PRMS_name,P.PRMS_description,RP.RLPR_FK_rol, RP.RLPR_state FROM  rolespermissions RP
RIGHT JOIN permissions P on p.PRMS_PK = RP.RLPR_FK_permission
LEFT JOIN roles R on RLPR_PK = RP.RLPR_FK_rol
WHERE RP.RLPR_FK_rol = 3;

*/

    public function listRolesPermissions($data)
    {
        $query = $this->db->table('permissions P')
                 ->select('P.PRMS_PK, P.PRMS_name, P.PRMS_description, RP.RLPR_FK_rol, RP.RLPR_state')
                 ->join('(SELECT * FROM rolespermissions WHERE RLPR_FK_rol = '.$data.') AS RP', 'P.PRMS_PK = RP.RLPR_FK_permission', 'left')
                 ->get();
         if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    public function validateRolesPermissionsId($rol,$permission)
    {
        $query = $this->where('RLPR_FK_permission',$permission)->where('RLPR_FK_rol',$rol)->first();
         if ($query) {
            return $query;
        } else { 
            return false;
        }
    }

    public function updateStateRolesPermissionsId($id,$user)
    {
         
        $query = $this->where('RLPR_PK',$id)->first();
        if($query['RLPR_state'] == 1){
            $query= $this->set('RLPR_state',0)
            ->set('RLPR_date_update',date('Y-m-d H:i:s'))
            ->set('RLPR_user_update',$user)
            ->where('RLPR_PK', $id);
            if($query->update()){
                return true;
            }else{
                return false;
            }
        }else{
            $query= $this->set('RLPR_state',1)
            ->set('RLPR_date_update',date('Y-m-d H:i:s'))
            ->set('RLPR_user_update',$user)
            ->where('RLPR_PK', $id);
            if($query->update()){
                return true;
            }else{
                return false;
            }
        }
           
    }
    public function addStateRolesPermissionsId($data)
    {
        $result = $this->insert($data);
        if($result){
            return $result;

        }else{
            return false;
        }
    }

}

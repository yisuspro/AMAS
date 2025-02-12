<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\CasesEntity;

class CasesModel extends Model
{
    protected $table            = 'cases';
    protected $primaryKey       = 'CASE_PK';
    
    protected $returnType       = CasesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'CASE_number',
        'CASE_date_reception',
        'CASE_date_solution',
        'CASE_FK_agent',
        'CASE_FK_tipe_case',
        'CASE_FK_state_case',
        'CASE_FK_entities',
        'CASE_FK_dependence',
        'CASE_FK_case_categorie',
        'CASE_FK_app' 
    ];

    public function listCaseID($id) {
        $builder = $this->db->table('CASES C')
            ->select("C.*, SC.STCS_name, TC.TPCS_name, G.GRPS_name, E.ENTS_name, CC.CTCS_name, DP.DPND_name, AP.APPS_name, 
                (SELECT GROUP_CONCAT(DISTINCT A.ACTN_modified_record SEPARATOR ', ') 
                FROM actions A 
                WHERE A.ACTN_FK_case = C.CASE_PK) AS actions, 
                (SELECT GROUP_CONCAT(DISTINCT OB.OBSV_name SEPARATOR ', ') 
                FROM observations OB 
                WHERE OB.OBSV_FK_case = C.CASE_PK) AS observations, U.USER_name,SC.STCS_name")
            ->join('statescases SC', 'C.CASE_FK_state_case = SC.STCS_PK', 'left')
            ->join('tipescases TC', 'C.CASE_FK_tipe_case = TC.TPCS_PK', 'left')
            ->join('groups G', 'TC.TPCS_FK_group = G.GRPS_PK', 'left')
            ->join('entities E', 'C.CASE_FK_entities = E.ENTS_PK', 'left')
            ->join('categoriescase CC', 'C.CASE_FK_case_categorie = CC.CTCS_PK', 'left')
            ->join('dependencies DP', 'C.CASE_FK_dependence = DP.DPND_PK', 'left')
            ->join('apps AP', 'C.CASE_FK_app = AP.APPS_PK', 'left')
            ->join('users U','C.CASE_FK_agent = U.USER_pk','left')
            ->where('C.CASE_FK_agent', $id);
        return $builder->get();
}
   
}

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

    /**
     * This PHP function retrieves a list of case details along with related information based on a
     * specified agent ID.
     * 
     * @param id The `listCaseID` function you provided seems to be a method in a PHP class that
     * retrieves information related to a specific case based on the provided agent ID. It constructs a
     * query to fetch data from multiple tables and returns the result.
     * 
     * @return The `listCaseID` function is returning a query result that fetches data related to a
     * specific case ID. The query selects various fields from the 'CASES' table along with additional
     * information from related tables such as 'statescases', 'tipescases', 'groups', 'entities',
     * 'categoriescase', 'dependencies', 'apps', and 'users'.
     */
    public function listCaseID($id)
    {
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
            ->join('users U', 'C.CASE_FK_agent = U.USER_pk', 'left')
            ->where('C.CASE_FK_agent', $id);
        return $builder->get();
    }

    /**
     * The insertCase function inserts case data and returns the insert ID if successful, otherwise it
     * returns false.
     * 
     * @param caseData The `insertCase` function takes in a parameter called ``, which likely
     * contains the data needed to insert a new record into a database table. This data could include
     * information such as case details, case number, case status, etc. The function attempts to insert
     * this data into the database using
     * 
     * @return If the `insert` method is successful in inserting the ``, the function will
     * return the ID of the inserted record using `insertID()`. If the insertion fails, it will return
     * `false`.
     */
    public function insertCase($caseData)
    {
      
       if ($this->insert($caseData)){
        return $this->insertID();
       }else{
        return false;
       }
       
    }
}

<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\CasesEntity;

/* The `CasesModel` class in PHP defines methods to retrieve and manipulate case data along with
related information from a database. */
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
                (SELECT GROUP_CONCAT(DISTINCT OB.OBSV_description SEPARATOR ', ') 
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
     * The `listCases` function retrieves a list of cases from a database with various related
     * information joined from multiple tables.
     * 
     * @return The `listCases` function is returning a list of cases from the database. The function is
     * using a query builder to select various fields from the 'CASES' table and joining it with
     * several other tables such as 'statescases', 'tipescases', 'groups', 'entities',
     * 'categoriescase', 'dependencies', 'apps', and 'users' based on their foreign key relationships.
     */
    public function listCases()
    {
        $builder = $this->db->table('CASES C')
            ->select("C.*, SC.STCS_name, TC.TPCS_name, G.GRPS_name, E.ENTS_name, CC.CTCS_name, DP.DPND_name, AP.APPS_name, 
                (SELECT GROUP_CONCAT(DISTINCT A.ACTN_modified_record SEPARATOR ', ') 
                FROM actions A 
                WHERE A.ACTN_FK_case = C.CASE_PK) AS actions, 
                (SELECT GROUP_CONCAT(DISTINCT OB.OBSV_description SEPARATOR ', ') 
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
            ->orderBy('C.CASE_PK','DESC');
        return $builder->get();
    }
   /**
    * This PHP function retrieves a list of case details along with related information from various
    * database tables based on a given case primary key.
    * 
    * @param CASE_PK The code snippet you provided is a PHP function that retrieves data related to a
    * specific case based on the `CASE_PK` parameter. It performs a SQL query to fetch information from
    * multiple tables by joining them based on foreign key relationships.
    * 
    * @return The function `listCasePk()` is returning a query builder object that fetches data
    * from the database table 'CASES' along with several joined tables based on the provided CASE_PK
    * value. The query selects various columns from the joined tables such as statescases, tipescases,
    * groups, entities, categoriescase, dependencies, apps, and users. The query fetches data where the
    */
    public function listCasePk($CASE_PK)
    {
        $builder = $this->select("*,
                SC.STCS_pk,SC.STCS_pk,
                TC.TPCS_name,TC.TPCS_pk, 
                G.GRPS_name,G.GRPS_pk,
                E.ENTS_name,E.ENTS_pk,
                CC.CTCS_name,CC.CTCS_pk,
                DP.DPND_name,DP.DPND_pk,
                AP.APPS_name,AP.APPS_pk,
                SC.STCS_name,SC.STCS_pk,
                (SELECT GROUP_CONCAT(DISTINCT OB.OBSV_description SEPARATOR ', ') 
                FROM observations OB 
                WHERE OB.OBSV_FK_case = CASE_PK) AS observations,
                (SELECT GROUP_CONCAT(DISTINCT A.ACTN_modified_record SEPARATOR ', ') 
                FROM actions A 
                WHERE A.ACTN_FK_case = CASE_PK) AS actions")
            ->join('statescases SC', 'CASE_FK_state_case = SC.STCS_PK', 'left')
            ->join('tipescases TC', 'CASE_FK_tipe_case = TC.TPCS_PK', 'left')
            ->join('groups G', 'TC.TPCS_FK_group = G.GRPS_PK', 'left')
            ->join('entities E', 'CASE_FK_entities = E.ENTS_PK', 'left')
            ->join('categoriescase CC', 'CASE_FK_case_categorie = CC.CTCS_PK', 'left')
            ->join('dependencies DP', 'CASE_FK_dependence = DP.DPND_PK', 'left')
            ->join('apps AP', 'CASE_FK_app = AP.APPS_PK', 'left')
            ->find($CASE_PK);
        return $builder;
    }


    /**
     * The function `listCaseDocument` retrieves case documents with various related information based on a
     * specified user document.
     * 
     * @param USER_document The `listCaseDocument` function seems to be querying a database to retrieve
     * case documents based on certain conditions. The function joins multiple tables to fetch related
     * information and filters the results based on the `ACTN_modified_record` column matching the provided
     * `` value.
     * 
     * @return The `listCaseDocument` function is returning a result set of records from a database query.
     * The function is selecting all columns (`*`) from a table and joining multiple tables using left
     * joins based on specified foreign key relationships. The query fetches records from tables
     * `statescases`, `tipescases`, `groups`, `entities`, `categoriescase`, `dependencies`, `apps`, and
     * `actions
     */
    public function listCaseDocument($USER_document)
    {
        $builder = $this->select("*")
            ->join('statescases SC', 'CASE_FK_state_case = SC.STCS_PK', 'left')
            ->join('tipescases TC', 'CASE_FK_tipe_case = TC.TPCS_PK', 'left')
            ->join('groups G', 'TC.TPCS_FK_group = G.GRPS_PK', 'left')
            ->join('entities E', 'CASE_FK_entities = E.ENTS_PK', 'left')
            ->join('categoriescase CC', 'CASE_FK_case_categorie = CC.CTCS_PK', 'left')
            ->join('dependencies DP', 'CASE_FK_dependence = DP.DPND_PK', 'left')
            ->join('apps AP', 'CASE_FK_app = AP.APPS_PK', 'left')
            ->join('actions AC', 'AC.ACTN_FK_case = CASE_PK AND ACTN_modified_record = '. $USER_document)
            ->findAll();
        return $builder;
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

    public function updateCase($caseData)
    {
      
        return $this->set($caseData)->where('CASE_PK', $caseData['CASE_PK'])->update() ? true : false;
       
    }
}

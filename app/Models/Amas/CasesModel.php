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


   
}

<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\AppspersonsEntity;

class AppspersonsModel extends Model
{
    protected $table            = 'appspersons';
    protected $primaryKey       = 'APPR_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = AppspersonsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "APPR_FK_app",  
        "APPR_FK_person",   
        "APPR_state",   
        "APPR_confidentiality", 
        "APPR_date_validity",   
        "APPR_ID_app",  
    ];

    public function getAppsByPerson($person) {
            return $this->where('APPR_FK_person',$person)
                ->join('apps', 'APPS_PK = APPR_FK_app', 'left')
                ->find();
    }
}

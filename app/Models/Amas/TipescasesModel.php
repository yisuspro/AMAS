<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\TipescasesEntity;

class TipescasesModel extends Model
{
    protected $table            = 'tipescases';
    protected $primaryKey       = 'TPCS_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = TipescasesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "TPCS_name",
        "TPCS_description",
        "TPCS_FK_group",
    ];
    public function listTipescases()
    {
        return $this->findAll();
    }

}

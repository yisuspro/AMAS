<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\StatescasesEntity;

class StatescasesModel extends Model
{
    protected $table            = 'statescases';
    protected $primaryKey       = 'STCS_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = StatescasesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "STCS_name",
        "STCS_description",
    ];
    public function listStatescases()
    {
        return $this->findAll();
    }

}

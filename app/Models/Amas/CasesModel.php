<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\CasesEntity;

class CasesModel extends Model
{
    protected $table            = 'cases';
    protected $primaryKey       = 'CASE_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = CasesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];
}

<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\CategoriescaseEntity;

class CategoriescaseModel extends Model
{
    protected $table            = 'categoriescases';
    protected $primaryKey       = 'CTCS_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = CategoriescaseEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "CTCS_PK",
        "CTCS_name",
        "CTCS_description",
    ];
}

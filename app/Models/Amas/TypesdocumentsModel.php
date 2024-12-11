<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\TypesdocumentsEntity;

class TypesdocumentsModel extends Model
{
    protected $table            = 'typesdocuments';
    protected $primaryKey       = 'TPDC_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = TypesdocumentsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "TPDC_name",
        "TPDC_description",
        "TPDC_state",
    ];
}

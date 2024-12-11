<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\ObservationsEntity;

class ObservationsModel extends Model
{
    protected $table            = 'observations';
    protected $primaryKey       = 'OBSV_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = ObservationsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "OBSV_name",
        "OBSV_description",
        "OBSV_FK_case",
    ];
}

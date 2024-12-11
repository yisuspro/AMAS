<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\ActionsEntity;

class ActionsModel extends Model
{
    protected $table            = 'actions';
    protected $primaryKey       = 'ACTN_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = ActionsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "ACTN_modified_record",
        "ACTN_description",
        "ACTN_description",
        "ACTN_FK_case"
    ];
}

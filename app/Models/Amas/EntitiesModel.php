<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\EntitiesEntity;

class EntitiesModel extends Model
{
    protected $table            = 'entities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = EntitiesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "ENTS_name",
        "ENTS_description",
    ];
}

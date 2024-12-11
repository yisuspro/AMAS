<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\GroupsEntity;

class GroupsModel extends Model
{
    protected $table            = 'groups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = GroupsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        
    ];

}

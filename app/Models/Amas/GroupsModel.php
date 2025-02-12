<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\GroupsEntity;

class GroupsModel extends Model
{
    protected $table            = 'groups';
    protected $primaryKey       = 'GRPS_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = GroupsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'GRPS_name',
        'GRPS_description'
    ];
    public function listGroups()
    {
        return $this->findAll();
    }


}

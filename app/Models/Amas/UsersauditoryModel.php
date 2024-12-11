<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\UsersauditoryEntity;

class UsersauditoryModel extends Model
{
    protected $table            = 'usersauditories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = UsersauditoryEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
    ];
}

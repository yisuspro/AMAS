<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\AppsEntity;

class AppsModel extends Model
{
    protected $table            = 'apps';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = AppsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        
    ];
}

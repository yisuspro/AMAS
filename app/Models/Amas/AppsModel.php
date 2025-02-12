<?php

namespace App\Models\Amas;

use CodeIgniter\Model;
use App\Entities\Amas\AppsEntity;

class AppsModel extends Model
{
    protected $table            = 'apps';
    protected $primaryKey       = 'APPS_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = AppsEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "APPS_name",
        "APPS_description"
    ];

    public function listApps()
    {
        return $this->findAll();
    }

}

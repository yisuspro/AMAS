<?php

namespace App\Models\Amas;

use CodeIgniter\Model;

use App\Entities\Amas\DependenciesEntity;

class DependenciesModel extends Model
{
    protected $table            = 'dependencies';
    protected $primaryKey       = 'DPND_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = DependenciesEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "DPND_name",
        "DPND_description",
    ];
    public function listDependencies()
    {
        return $this->findAll();
    }

}

<?php

namespace App\Models\Amas;

use CodeIgniter\Model;

class DependenciesModel extends Model
{
    protected $table            = 'dependencies';
    protected $primaryKey       = 'DPND_PK';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "DPND_name",
        "DPND_description",
    ];
}

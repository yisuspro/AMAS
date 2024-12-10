<?php

namespace App\Entities\Amas;

use CodeIgniter\Entity\Entity;

class DocumentspersonsEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

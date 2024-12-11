<?php

namespace App\Entities\Amas;

use CodeIgniter\Entity\Entity;

class CasesEntity extends Entity
{
    protected $dates   = ['CASE_date_reception', 'CASE_date_solution'];
}

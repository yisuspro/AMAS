<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ControllerSeeders extends Seeder
{
    public function run()
    {
        $this->call('States');
        $this->call('Categories');
        $this->call('Roles');
        $this->call('Entities');
    }
}

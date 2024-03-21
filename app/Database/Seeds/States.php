<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class States extends Seeder
{
    public function run()
    {
       // cargamos datos base de la tabla para estados de usuarios
        $dataStatesUsers = [
            [   
                'STTS_PK'   =>  0,
                'STTS_name' => 'INACTIVO',
                'STTS_description'    => 'USUARIO INACTIVO'
            ],
            [
                'STTS_PK'   =>  1,
                'STTS_name' => 'ACTIVO',
                'STTS_description'    => 'USUARIO ACTIVO'
            ],            
            [
                'STTS_PK'   =>  2,
                'STTS_name' => 'SUSPENDIDO',
                'STTS_description'    => 'USUARIO INACTIVO'
            ]
        ];
        $this->db->table('statesusers')->insertBatch($dataStatesUsers);


        // cargamos datos base de la tabla para estados de los casos
        $dataStatesCases = 
        [
            [   
                'STCS_PK'   =>  0,
                'STCS_name' => 'SOLUCIONADO',
                'STCS_description'    => 'CASO SOLUCIONADO'
            ],
            [
                'STCS_PK'   =>  1,
                'STCS_name' => 'RECHAZADO',
                'STCS_description'    => 'CASO RECHAZADO'
            ],            
            [
                'STCS_PK'   =>  2,
                'STCS_name' => 'SUSPENDIDO',
                'STCS_description'    => 'CASO SUSPENDIDO'
            ]
        ];
        $this->db->table('statescases')->insertBatch($dataStatesCases);


    }
}

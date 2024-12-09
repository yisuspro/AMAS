<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Documents extends Seeder
{
    public function run()
    {
       // Cargamos datos base de la tabla para tipos de documentos
        $datatypeDocuments = [
            [   
                'TPDC_PK' =>  1,
                'TPDC_name' => 'Documento de identidad',
                'TPDC_description' => 'Documento de identificación como Cédula / Tarjeta de identidad/ Registro',
                'TPDC_state' => 1
            ],
            [   
                'TPDC_PK' =>  2,
                'TPDC_name' => 'Acuerdo de confidencialidad',
                'TPDC_description' => 'Acuerdo de confidencialidad',
                'TPDC_state' => 1
            ],
        ];
        $this->db->table('typesdocuments')->insertBatch($datatypeDocuments);
    }
}

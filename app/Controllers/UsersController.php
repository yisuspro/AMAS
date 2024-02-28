<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;

class UsersController extends BaseController
{
   
    
    public function index()
    {
        $db = $this->bd_amas->query('select * from users');
        $db_caracterizacion = $this->bd_caracterizacion->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        //$query = $db->query('select * from users');
        $query = $db;
        $query = $query->getResult();
        foreach($query as $doc){
            echo json_encode($doc);
        }
        
        //$query = $db_prueba->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        
        echo json_encode ($db_caracterizacion->getResult());
    }
}

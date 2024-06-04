<?php

namespace App\Controllers\Sirav;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Sirav\UsersSiravModel;

class UsersSiravController extends BaseController
{

    protected $UsersSiravModel;

    public function __construct()
    {
        $this->UsersSiravModel = new UsersSiravModel();
    }

    public function index()
    {
        
    }

    public function listUser($tipo, $parametro)
    {

        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        switch ($tipo) { //utiliza el metodo listUsersDoc() del modelo UsersRuvModel() para traer los datos de todos los planes 
            case 0:
                $data = $this->UsersSiravModel->listUsersDoc($parametro);
                break;
            case 1:
                $data = $this->UsersSiravModel->listUsersName($parametro);
                break;
        }
                  
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }
}

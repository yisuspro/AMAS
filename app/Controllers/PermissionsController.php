<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PermissionsModel;

class PermissionsController extends BaseController
{

    protected $PermissionsModel;

    public function __construct()
    {
        $this->PermissionsModel = new PermissionsModel();
    }



    public function index()
    {
        return view('private/views_ajax/permissions/listPermissionsAjax', ['title' => 'Listar Permisos']);
    }


    public function listPermissions()
    {
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->PermissionsModel->listPermissions();             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }

    public function createPermissions()
    {
        $permissionData = [
            'PRMS_name' => $this->request->getPost('PRMS_name'),
            'PRMS_description' => $this->request->getPost('PRMS_description'),
            'PRMS_system_name' => $this->request->getPost('PRMS_system_name'),
            'PRMS_date_create' => date('Y-m-d H:i:s'),
            'PRMS_date_update' => date('Y-m-d H:i:s'),
            'PRMS_user_create' => $this->session->get('USER_PK'),
            'PRMS_user_update' => $this->session->get('USER_PK'),
            'PRMS_state' => 1
        ];
        if ($this->PermissionsModel->validatePermissions($permissionData['PRMS_system_name'])) {

            echo json_encode('Error nombre corto de permiso ya existe');
            $this->response->setStatusCode(401);
        } else {
            if ($result = $this->PermissionsModel->insertPermissions($permissionData)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al crear permiso');
                $this->response->setStatusCode(401);
            }
        }
    }
}

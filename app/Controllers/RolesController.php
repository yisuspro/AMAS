<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
//use App\Models\RolesModel;

class RolesController extends BaseController
{


    public function __construct()
    {
        
    }

    public function index()
    {
        return view('private/views_ajax/roles/listRolesAjax', ['title' => 'Listar roles']);
    }

    public function listRoles()
    {
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->RolesModel->listRoles();             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }


    public function createRoles()
    {
        $rolData = [
            'ROLE_name' => $this->request->getPost('ROLE_name'),
            'ROLE_description' => $this->request->getPost('ROLE_description'),
            'ROLE_date_create' => date('Y-m-d H:i:s'),
            'ROLE_date_update' => date('Y-m-d H:i:s'),
            'ROLE_FK_user_create' => $this->session->get('USER_PK'),
            'ROLE_FK_user_update' => $this->session->get('USER_PK'),
            'ROLE_state' => 1
        ];

        if ($result = $this->RolesModel->insertRoles($rolData)) {
            $this->response->setStatusCode(201);
        } else {
            echo json_encode('Error al crear permiso');
            $this->response->setStatusCode(401);
        }
    }

    public function updateRolesView($id)
    {
        $data = $this->RolesModel->viewRoles($id);

        return view('private/views_ajax/roles/updateRolesAjax', ['title' => 'Actualizar Roles', 'data' => $data->getResultArray()]);
    }

    public function updateRoles()
    {
        $roleData = [
            'ROLE_PK' =>  $this->request->getPost('ROLE_PK'),
            'ROLE_name' => $this->request->getPost('ROLE_name'),
            'ROLE_description' => $this->request->getPost('ROLE_description'),
            'ROLE_date_update' => date('Y-m-d H:i:s'),
            'ROLE_user_update' => $this->session->get('USER_PK'),
            'ROLE_state' => 1
        ];
        if ($this->RolesModel->validateRolesId($roleData['ROLE_PK'])) {
            if ($this->RolesModel->updateRoles($roleData)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al actualizar el Rol');
                $this->response->setStatusCode(401);
            }
        } else {
            echo json_encode('Error no se encuentra rol');
            $this->response->setStatusCode(401);
        }
    }

    public function updateStateRoles($id)
    {
        $result = $this->RolesModel->validateRolesId($id);
        if ($result['ROLE_state'] == 1) {
            $result['ROLE_state'] = 0;
            if ($this->RolesModel->updateRoles($result)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al actualizar estado del roles');
                $this->response->setStatusCode(401);
            }
        } else {
            $result['ROLE_state'] = 1;
            if ($this->RolesModel->updateRoles($result)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al actualizar estado del roles');
                $this->response->setStatusCode(401);
            }
        }
    }

    public function addPermissionsRolesViews($id)
    {

        return view('private/views_ajax/roles/addPermissionsRolesAjax', ['title' => 'Asignar permisos ',  'id' => $id]);
    }

    public function listRolesPermissions($id)
    {

        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $data = $this->RolespermissionsModel->listRolesPermissions($id);           //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }

    public function addPermissionsRoles($permission, $rol)
    {
        echo $permission."/". $rol;
        $validacion = $this->RolespermissionsModel->validateRolesPermissionsId($rol, $permission);
        if ($validacion) {
            $userUpdate = $this->session->get('USER_PK');
            if ($this->RolespermissionsModel->updateStateRolesPermissionsId($validacion['RLPR_PK'],$userUpdate)) {
                echo json_encode('permiso asignado exitosamente');
                $this->response->setStatusCode(200);
            } else {
                echo json_encode('error al asignar el permiso');
                $this->response->setStatusCode(401);
            }
        } else {
            $data = [
                'RLPR_date_create' => date('Y-m-d H:i:s'),
                'RLPR_date_update' => date('Y-m-d H:i:s'),
                'RLPR_user_create' => $this->session->get('USER_PK'),
                'RLPR_user_update' => $this->session->get('USER_PK'),
                'RLPR_FK_permission' => $permission,
                'RLPR_FK_rol' => $rol,
                'RLPR_state' => 1,
            ];
            if ($this->RolespermissionsModel->addStateRolesPermissionsId($data)) {
                echo json_encode('permiso agregado exitosamente');
                $this->response->setStatusCode(200);
            } else {
                echo json_encode('error al agregar permiso');
                $this->response->setStatusCode(401);
            }
        }
    }
}

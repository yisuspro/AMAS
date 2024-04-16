<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use App\Models\UsersModel;
use function App\Helpers\generar_menu;

class UsersController extends BaseController
{

    protected $UsersModel;

    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        return view('login');
        /* $db = $this->bd_amas->query('select * from users');
        $db_caracterizacion = $this->bd_caracterizacion->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        $db_ruv = $this->bd_ruv->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        $db_sipod = $this->bd_sipod->query('select * from SIPOD.TBUSUARIOS where id = 10218');
        $db_sirav = $this->bd_sirav->query('select * FROM SIRAVAdmin.dbo.USUARIO WHERE ID = 13487');
        
       // foreach($query as $doc){
          //  echo json_encode($doc);
        //}
        
        //$query = $db_prueba->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        
       // echo json_encode ($db_caracterizacion->getResult());
        //echo json_encode ($db_sirav->getResult());*/
    }
    public function listUsersView()
    {
        return view('private/views_ajax/users/listUserAjax', ['title' => 'Cunsulta usuario']);
    }

    public function listUser()
    {
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->UsersModel->listUsers();             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;    
    }

    public function register()
    {
        // Datos del nuevo usuario
        $userData = [
            'USER_name' => $this->request->getPost('USER_name'),
            'USER_username' => $this->request->getPost('USER_username'),
            'USER_identification' => $this->request->getPost('USER_identification'),
            'USER_password' =>  $this->request->getPost('USER_password'),
            'USER_date_create' => date('Y-m-d H:i:s'),
            'USER_date_update' => date('Y-m-d H:i:s'),
            'USER_FK_user_create' => $this->session->get('USER_PK'),
            'USER_FK_user_update' => $this->session->get('USER_PK'),
            'USER_FK_state_user' => 1,
        ];
        if ($this->UsersModel->validateUserDoc($userData['USER_identification'])) {

            if ($result = $this->UsersModel->insertUser($userData)) {

                $this->response->setStatusCode(200);
            } else {
                echo json_encode('Error al crear usuario');
                $this->response->setStatusCode(401);
            }
        } else {
            echo json_encode('usuario ya existe');
            $this->response->setStatusCode(401);
        }
    }

    public function login()
    {
        // Obtener los datos del formulario enviados por AJAX
        $username = $this->request->getPost('USER_username');
        $password = $this->request->getPost('USER_password');

        if ($username != null and $password != null) {
            $data = [
                'USER_username' => $this->request->getPost('USER_username'),
                'USER_password' => $this->request->getPost('USER_password'),
            ];
            $validacion = $this->UsersModel->validateUser($data);
            if ($validacion) {
                echo json_encode('el usuario y contraseña son correctos');
                $userData = [
                    'USER_PK' => $validacion['USER_PK'],
                    'USER_name' => $validacion['USER_name'],
                    'USER_username' => $validacion['USER_username']
                ];
                $this->session->set($userData);
                $this->response->setStatusCode(200);
            } else {
                $this->response->setStatusCode(401);
                echo json_encode('error usuario o contraseña no coincide');
            }
        } else {
            $this->response->setStatusCode(401);
            echo json_encode('por favor ingresa los datos completos');
        }
    }
    public function logout()
    {
        $this->session->destroy();
        $this->response->setStatusCode(200);
        return true;
    }

    public function profileUser()
    {
        return view('private/profileUser', ['title' => 'Perfil']);
    }

    public function createUserView()
    {
        return view('private/views_ajax/users/createUserAjax', ['title' => 'Crear usuario']);
    }

    
}

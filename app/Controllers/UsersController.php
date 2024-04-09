<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use App\Models\UsersModel;

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

    public function insert()
    {
        // Datos del nuevo usuario
        $userData = [
            'USER_name' => 'admin',
            'USER_username' => 'admin',
            'USER_password' => 'admin123*',
            'USER_date_create' => date('Y-m-d H:i:s'),
            'USER_date_update' => date('Y-m-d H:i:s'),
            'USER_FK_user_create' => 1,
            'USER_FK_user_update' => 1,
            'USER_FK_state_user' => 1,
        ];

        // Insertar el nuevo usuario
        if ($this->UsersModel->insertUser($userData)) {
            echo "registrado";
        } else {
            echo "no registrado";
        }

        // Redirigir o mostrar un mensaje de éxito*/
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
    }

    public function profileUser()
    {
        return view('private/profileUser',['title' => $this->session->get('USER_PK')]);
    }
}

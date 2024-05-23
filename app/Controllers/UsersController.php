<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use function App\Helpers\generar_menu;

class UsersController extends BaseController
{

    public function __construct()
    {
    }

    /* ******************************** 
        Carga la vista del login.
        creado por: jesus andres castellanos
        documentado por: daniela silvestre
        variables de ingreso: niguna
    ************************************ */
    public function index()
    {
        return view('login');
        /* 
        $db = $this->bd_amas->query('select * from users');
        $db_caracterizacion = $this->bd_caracterizacion->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        $db_ruv = $this->bd_ruv->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        $db_sipod = $this->bd_sipod->query('select * from SIPOD.TBUSUARIOS where id = 10218');
        $db_sirav = $this->bd_sirav->query('select * FROM SIRAVAdmin.dbo.USUARIO WHERE ID = 13487');
        
        foreach($query as $doc){
         echo json_encode($doc);
        }
        
        $query = $db_prueba->query('select * from TBDECLARACIONES WHERE ID = 2000227');
        
        echo json_encode ($db_caracterizacion->getResult());
        echo json_encode ($db_sirav->getResult());
        */
    }
    /* ******************************** 
        Obtiene los roles del usuario actual y los retorna en formato JSON.
        creado por: jesus andres castellanos
        documentado por: daniela silvestre
        variables de ingreso: niguna
    ************************************ */

    public function getPermissionsUsers()
    {
        $Roles = $this->UsersrolesModel->validateRolesUser($this->session->get('USER_PK'));
        echo json_encode($Roles);
    }
    public function listUsersView()
    {
        return view('private/views_ajax/users/listUserAjax', ['title' => 'Cunsulta usuario']);
    }

    public function profileUser()
    {

        $Roles = $this->UsersrolesModel->validateRolesUser($this->session->get('USER_PK'));

        $menu = generate_menu($Roles);
        return view('private/profileUser', ['title' => 'Perfil', 'menu' => $menu]);
    }

    public function createUserView()
    {
        return view('private/views_ajax/users/createUserAjax', ['title' => 'Crear usuario']);
    }

    public function updatetUserView($id)
    {
        $data = $this->UsersModel->viewUsers($id);
        return view('private/views_ajax/users/updateUserAjax', ['title' => 'Actualizar usuario', 'data' => $data->getResultArray()]);
    }
    public function UpdatePasswordUserView($id)
    {
        return view('updatePasswordUSer', ['title' => 'Cambio de contraseña', 'USER_PK' => $id]);
    }

    public function addRolesUsersView($id)
    {

        return view('private/views_ajax/users/addRolesUsersAjax', ['title' => 'Asignar roles ',  'id' => $id]);
    }
    public function listUser()
    {
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->UsersModel->listUsers();             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }

    public function register()
    {
        // Datos del nuevo usuario

        if ($this->request->getPost('USER_password') == $this->request->getPost('USER_password_two')) {
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
                'USER_reset_password' => 1,
                'USER_email' => $this->request->getPost('USER_email'),
                'USER_address_ip' => $this->request->getPost('USER_address_ip'),

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
        } else {
            echo json_encode('contraseña no coincide');
            $this->response->setStatusCode(401);
        }
    }

    public function login()
    {
        // Obtener los datos del formulario enviados por AJAX
        $username = $this->request->getPost('USER_username');
        $password = $this->request->getPost('USER_password');
        $addressIp = $_SERVER['REMOTE_ADDR'];

        if ($username != null and $password != null) {
            $data = [
                'USER_username' => $this->request->getPost('USER_username'),
                'USER_password' => $this->request->getPost('USER_password'),
            ];
            $validacion = $this->UsersModel->validateUser($data);
            if ($validacion) {
                if ($this->UsersModel->validateIPUser($validacion['USER_PK'],$addressIp)) {
                    if ($validacion['USER_FK_state_user'] == 1) {
                        $permissions = $this->UsersrolesModel->validateRolesUser($validacion['USER_PK']);

                        $userData = [
                            'USER_PK' => $validacion['USER_PK'],
                            'USER_name' => $validacion['USER_name'],
                            'USER_username' => $validacion['USER_username'],
                            'PERMISSIONS' => $permissions
                        ];

                        $this->session->set($userData);
                        echo json_encode([
                            'msg' => 'el usuario y contraseña son correctos',
                            'USER_PK' => $validacion['USER_PK'],
                            'USER_reset_password' => $validacion['USER_reset_password']
                        ]);
                    } else {
                        $this->response->setStatusCode(401);
                        echo json_encode('Error: Usuario inactivo, por favor validar con el administrador del sistema');
                    }
                } else {
                    $this->response->setStatusCode(401);
                    echo json_encode('Error: la direccion IP no coincide con el reistrado para el usaurio');
                }
            } else {
                $this->response->setStatusCode(401);
                echo json_encode('Error: usuario o contraseña no coincide');
            }
        } else {
            $this->response->setStatusCode(401);
            echo json_encode('Error: por favor ingresa los datos completos');
        }
    }


    public function logout()
    {
        $this->session->destroy();
        $this->response->setStatusCode(200);
        return true;
    }

    public function updateUsers()
    {
        // Datos del nuevo usuario
        $userData = [
            'USER_PK' => $this->request->getPost('USER_PK'),
            'USER_name' => $this->request->getPost('USER_name'),
            'USER_username' => $this->request->getPost('USER_username'),
            'USER_identification' => $this->request->getPost('USER_identification'),
            'USER_date_update' => date('Y-m-d H:i:s'),
            'USER_FK_user_update' => $this->session->get('USER_PK'),
            'USER_email' => $this->request->getPost('USER_email'),
            'USER_address_ip' => $this->request->getPost('USER_address_ip'),
        ];
        if ($result = $this->UsersModel->updateUsers($userData)) {
            $this->response->setStatusCode(200);
        } else {
            echo json_encode('Error al crear usuario');
            $this->response->setStatusCode(401);
        }
    }

    public function updateStateUsers($id)
    {
        $result = $this->UsersModel->validateUserId($id);
        //echo json_encode ($result);
        if ($result) {
            if ($result['USER_FK_state_user'] == 1) {
                $result['USER_FK_state_user'] = 0;
                if ($this->UsersModel->updateUsers($result)) {
                    echo json_encode('Cambio exitoso');
                    $this->response->setStatusCode(201);
                } else {
                    echo json_encode('Error al actualizar estado del usuario');
                    $this->response->setStatusCode(401);
                }
            } else {
                $result['USER_FK_state_user'] = 1;
                if ($this->UsersModel->updateUsers($result)) {
                    $this->response->setStatusCode(201);
                } else {
                    echo json_encode('Error al actualizar estado del usuario');
                    $this->response->setStatusCode(401);
                }
            }
        } else {
            echo json_encode('Error usuario no encontrado');
            $this->response->setStatusCode(401);
        }
    }

    public function updatePasswordUsers()
    {
        if ($this->request->getPost('USER_password_P') == $this->request->getPost('USER_password_two_P')) {
            $userData = [
                'USER_PK' => $this->request->getPost('USER_PK_P'),
                'USER_password' => $this->request->getPost('USER_password_P'),
                'USER_reset_password' => 1,
                'USER_date_update' => date('Y-m-d H:i:s'),
                'USER_FK_user_update' => $this->session->get('USER_PK')
            ];

            if ($this->UsersModel->updatePasswordUsers($userData)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al actualizar contraseña');
                $this->response->setStatusCode(401);
            }
        } else {
            echo json_encode('contraseñas no coinciden');
            $this->response->setStatusCode(401);
        }
    }


    public function UpdatePasswordUser()
    {
        $validate = $this->UsersModel->validateUserId($this->request->getPost('USER_PK_P'));
        $contraseñaActual = $this->request->getPost('USER_password_A');
        $contraseñaNueva = $this->request->getPost('USER_password_P');
        $confirmacionContraseña = $this->request->getPost('USER_password_two_P');

        $contrasena = $this->UsersModel->validatePasswords($contraseñaActual, $validate['USER_password']);
        if ($contrasena) {

            if ($contraseñaNueva == $confirmacionContraseña) {
                $userData = [
                    'USER_PK' => $this->request->getPost('USER_PK_P'),
                    'USER_password' => $contraseñaNueva,
                    'USER_reset_password' => 0,
                    'USER_date_update' => date('Y-m-d H:i:s'),
                    'USER_FK_user_update' => $this->session->get('USER_PK')
                ];
                if ($this->UsersModel->updatePasswordUsers($userData)) {
                    $this->response->setStatusCode(201);
                } else {
                    echo json_encode('Error al actualizar contraseña');
                    $this->response->setStatusCode(401);
                }
            } else {
                echo json_encode('contraseñas no coinciden');
                $this->response->setStatusCode(402);
            }
        } else {
            echo json_encode('contraseña actual no coinciden');
            $this->response->setStatusCode(403);
        }
    }

    public function listUsersRoles($id)
    {
        $draw   = intval($this->request->getPost("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $data = $this->UsersrolesModel->listUsersRoles($id);             //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" => $data->getNumRows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->getNumRows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->getResultArray()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit;
    }


    public function addRolesUsers($ROLE_PK, $USER_PK)
    {
        echo $ROLE_PK . "/" . $USER_PK;
        $validacion = $this->UsersrolesModel->validateUsersRolesId($USER_PK, $ROLE_PK);
        if ($validacion) {
            if ($this->UsersrolesModel->updateStateUsersRolesId($validacion['USRL_PK'], $this->session->get('USER_PK'))) {
                echo json_encode('rol asignado exitosamente');
                $this->response->setStatusCode(200);
            } else {
                echo json_encode('error al asignar el permiso');
                $this->response->setStatusCode(401);
            }
        } else {
            $data = [
                'USRL_date_create' => date('Y-m-d H:i:s'),
                'USRL_date_update' => date('Y-m-d H:i:s'),
                'USRL_user_create' => $this->session->get('USER_PK'),
                'USRL_user_update' => $this->session->get('USER_PK'),
                'USRL_FK_rol' => $ROLE_PK,
                'USRL_FK_user' => $USER_PK,
                'USRL_state' => 1,
            ];
            if ($this->UsersrolesModel->addStateUsersRolesId($data)) {
                echo json_encode('rol agregado exitosamente');
                $this->response->setStatusCode(200);
            } else {
                echo json_encode('error al agregar rol');
                $this->response->setStatusCode(401);
            }
        }
    }




    public function prueba()
    {
        //$Roles =[8,6,7];
        //$permissions = $this->RolespermissionsModel->validatePermissionsRole($Roles);
        $Roles = $this->UsersrolesModel->validateRolesUser(2);
        echo json_encode($Roles);
    }
}

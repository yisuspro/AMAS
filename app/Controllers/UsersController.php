<?php

namespace App\Controllers;

use CodeIgniter\Database\Query;
use function App\Helpers\menu_helper;

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
    /**
     * The listUsersView function returns a view for listing users with the title "Consulta usuario".
     * 
     * @return A view named 'listUserAjax' located in the 'private/views_ajax/users' directory with the
     * title 'Consulta usuario' being passed as data.
     */
    public function listUsersView()
    {
        return view('private/views_ajax/users/listUserAjax', ['title' => 'Consulta usuario']);
    }

    /**
     * The profileUser function retrieves user roles, generates a menu based on those roles, and
     * returns a view for the user's profile page.
     * 
     * @return The `profileUser` function is returning a view named 'private/profileUser' with the
     * title 'Perfil' and a menu generated based on the roles of the current user. The menu is
     * generated using the `generate_menu` function with the roles passed as a parameter.
     */
    public function profileUser()
    {
        $Roles = $this->UsersrolesModel->validateRolesUser($this->session->get('USER_PK'));
        $menu = generate_menu($Roles);
        return view('private/profileUser', ['title' => 'Perfil', 'menu' => $menu]);
    }

    /**
     * The function `createUserView` returns a view for creating a user with the title "Crear usuario".
     * 
     * @return A view named 'createUserAjax' located in the 'private/views_ajax/users' directory with
     * the title 'Crear usuario' being passed as data.
     */
    public function createUserView()
    {
        return view('private/views_ajax/users/createUserAjax', ['title' => 'Crear usuario']);
    }

    /**
     * The function `updateUserView` retrieves user data and passes it to a view for updating a user via
     * AJAX in a PHP application.
     * 
     * @param id The `updatetUserView` function seems to be a method in a PHP class that is responsible for
     * fetching user data based on the provided `` and then passing that data to a view for rendering.
     * 
     * @return A view named 'updateUserAjax' is being returned with the title 'Actualizar usuario' and the
     * data fetched from the UsersModel for the specified user ID. The data is passed to the view as an
     * array with the key 'data'.
     */
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

    public function consultarUsersAppsView()
    {
        return view('private/views_ajax/Ruv/consultarUsuariosAjax', ['title' => 'Cunsulta usuarios Aplicaciones']);
    }

    public function resultConsultarUsersAppsView($tipo,$parametro)
    {
        $aplicaciones =[
            'Ruv' => false,
            'Sirav' => false,
            'Sipod' => false,
        ];
        switch ($tipo) { //utiliza el metodo listUsersDoc() del modelo UsersRuvModel() para traer los datos de todos los planes 
            case 0:
                if( $this->UsersRuvModel->listUsersDoc($parametro)->getResultArray()){
                    $aplicaciones['Ruv'] = true;
                }
        
                if($this->UsersSiravModel->listUsersDoc($parametro)->getResultArray()){
                    $aplicaciones ['Sirav'] = true;
                }
        
                if($this->UsersSipodModel->listUsersDoc($parametro)->getResultArray()){
                    $aplicaciones ['Sipod'] = true;
                }
                break;
            case 1:
                if( $this->UsersRuvModel->listUsersName($parametro)->getResultArray()){
                    $aplicaciones['Ruv'] = true;
                }
        
                /*if($this->UsersSiravModel->listUsersName($parametro)->getResultArray()){
                    $aplicaciones ['Sirav'] = true;
                }
        
                if($this->UsersSipodModel->listUsersName($parametro)->getResultArray()){
                    $aplicaciones ['Sipod'] = true;
                }*/
                break;
        }
            
        return view('private/views_ajax/Ruv/listUserAjax', ['title' => 'Cunsulta usuarios RUV', 'tipo' => $tipo, 'parametro' => $parametro, 'aplicaciones'=> $aplicaciones]);
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
                            'msg' => 'El usuario y contraseña son correctos',
                            'USER_PK' => $validacion['USER_PK'],
                            'USER_reset_password' => $validacion['USER_reset_password']
                        ]);
                    } else {
                        $this->response->setStatusCode(401);
                        echo json_encode('Error: Usuario inactivo, por favor validar con el administrador del sistema');
                    }
                } else {
                    $this->response->setStatusCode(401);
                    echo json_encode('Error: La direccion IP no coincide con el registrado para el usuario');
                }
            } else {
                $this->response->setStatusCode(401);
                echo json_encode('Error: Usuario o contraseña no coincide');
            }
        } else {
            $this->response->setStatusCode(401);
            echo json_encode('Error: Por favor ingresa los datos completos');
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
        $Roles =  $this->UsersRuvModel->prueba();
        echo json_encode($Roles);
    }
}

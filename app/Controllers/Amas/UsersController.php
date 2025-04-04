<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;

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
    * The function `updateUserView` retrieves user data and returns a view for updating a user with the
    * specified ID.
    * 
    * @param id The `id` parameter in the `updateUserView` function is used to identify the user whose
    * information needs to be updated. This function retrieves the user data based on the provided `id`
    * and then passes that data to the view for displaying the user update form.
    * 
    * @return The `updatetUserView` function is returning a view called 'updateUserAjax' located in the
    * 'private/views_ajax/users' directory. It is passing an array with the keys 'title' set to
    * 'Actualizar usuario' and 'data' containing the user information fetched from the `viewUsers`
    * method in the `UsersModel`.
    */
    public function updatetUserView($id)
    {
        $data = $this->UsersModel->viewUsers($id);
        return view('private/views_ajax/users/updateUserAjax', ['title' => 'Actualizar usuario', 'data' => $data]);
    }

    /**
     * The function UpdatePasswordUserView displays a view for updating a user's password with the
     * specified user ID.
     * 
     * @param id The `UpdatePasswordUserView` function is a PHP function that generates a view for
     * updating a user's password. The function takes an `` parameter, which is used to identify the
     * user for whom the password is being updated.
     * 
     * @return A view named 'updatePasswordUSer' is being returned with the title 'Cambio de
     * contraseña' and the USER_PK value set to the provided  parameter.
     */
    public function UpdatePasswordUserView($id)
    {
        return view('updatePasswordUser', ['title' => 'Cambio de contraseña', 'USER_PK' => $id]);
    }

    /**
     * The function `addRolesUsersView` returns a view for assigning roles to users with specified
     * title and ID.
     * 
     * @param id The `id` parameter in the `addRolesUsersView` function is used to pass the identifier
     * of a user to the view. This identifier is then used within the view to perform operations
     * specific to that user, such as assigning roles.
     * 
     * @return A view named 'addRolesUsersAjax' located in the 'private/views_ajax/users' directory is
     * being returned with the data array containing the title 'Asignar roles' and the id passed as a
     * parameter.
     */
    public function addRolesUsersView($id)
    {
        return view('private/views_ajax/users/addRolesUsersAjax', ['title' => 'Asignar roles ',  'id' => $id]);
    }

/**
 * The `listUser` function retrieves user data from a model, prepares it for display in a table with
 * pagination, and returns it in JSON format.
 */

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
/**
 * The function `register` in PHP checks if two passwords match before creating a new user with
 * provided data.
 *//**
  * The function `register` in PHP handles user registration by validating input data and inserting a
  * new user into the database if the passwords match and the user does not already exist.
  */
 

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

   /**
    * The PHP function `login` handles user authentication by validating credentials, IP address, and
    * user status before setting session data or returning appropriate error messages.
    */
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
                if ($this->UsersModel->validateIPUser($validacion->USER_PK,$addressIp)) {
                    if ($validacion->USER_FK_state_user == 1) {
                        $permissions = $this->UsersrolesModel->validateRolesUser($validacion->USER_PK);

                        $userData = [
                            'USER_PK' => $validacion->USER_PK,
                            'USER_name' => $validacion->USER_name,
                            'USER_username' => $validacion->USER_username,
                            'PERMISSIONS' => $permissions
                        ];

                        $this->session->set($userData);
                        echo json_encode([
                            'msg' => 'El usuario y contraseña son correctos',
                            'USER_PK' => $validacion->USER_PK,
                            'USER_reset_password' => $validacion->USER_reset_password
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

/**
 * The `logout` function in PHP destroys the session and sets the response status code to 200 before
 * returning true.
 * 
 * @return The `logout` function is returning a boolean value `true`.
 */

    public function logout()
    {
        $this->session->destroy();
        $this->response->setStatusCode(200);
        return true;
    }
/**
 * The function `updateUsers` updates user data in a PHP application based on the provided input.
 */

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
        if ($this->UsersModel->updateUsers($userData)) {
            $this->response->setStatusCode(200);
        } else {
            echo json_encode('Error al crear usuario');
            $this->response->setStatusCode(401);
        }
    }

   /**
    * The function `updateStateUsers` checks and updates the state of a user based on their ID in a PHP
    * application.
    * 
    * @param id The `updateStateUsers` function you provided seems to be updating the state of a user
    * based on the user's ID. The function first validates the user ID, then checks the current state
    * of the user, and toggles it between 0 and 1.
    */
    public function updateStateUsers($id)
    {
        $result = $this->UsersModel->validateUserId($id);
       
        if ($result) {
            if ($result->USER_FK_state_user == 1) {
                $result->USER_FK_state_user = 0;
                if ($this->UsersModel->updateUsers($result)) {
                    echo json_encode('Cambio exitoso');
                    $this->response->setStatusCode(201);
                } else {
                    echo json_encode('Error al actualizar estado del usuario');
                    $this->response->setStatusCode(401);
                }
            } else {
                $result->USER_FK_state_user = 1;
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

   /**
    * The function `updatePasswordUsers` in PHP checks if two passwords match, updates the user's
    * password in the database, and sets appropriate response status codes based on the outcome.
    */
    public function updatePasswordUsers()
    {
        if ($this->request->getPost('USER_password_P') == $this->request->getPost('USER_password_two_P')) {
            $result = $this->UsersModel->validateUserId($this->request->getPost('USER_PK_P'));
            $result->USER_password = $this->request->getPost('USER_password_P');
            $result->USER_reset_password = 1;
            $result->USER_FK_user_update = $this->session->get('USER_PK');

            if ($this->UsersModel->updatePasswordUsers($result)) {
                $this->response->setStatusCode(201);
            } else {
                echo json_encode('Error al actualizar contraseña');
                $this->response->setStatusCode(401);
            }
        } else {
            echo json_encode('Contraseñas no coinciden');
            $this->response->setStatusCode(401);
        }
    }
/**
 * The function `UpdatePasswordUser` validates and updates a user's password based on input data.
 */


    public function UpdatePasswordUser()
    {
        $validate = $this->UsersModel->validateUserId($this->request->getPost('USER_PK_P'));
        
        $password = $this->UsersModel->validatePasswords($this->request->getPost('USER_password_A'), $validate->USER_password);
        if ($password) {

            if ($this->request->getPost('USER_password_P') == $this->request->getPost('USER_password_two_P')) {
                $userData = [
                    'USER_PK' => $this->request->getPost('USER_PK_P'),
                    'USER_password' => $this->request->getPost('USER_password_P'),
                    'USER_reset_password' => 0,
                    'USER_date_update' => date('Y-m-d H:i:s'),

                ];
                if ($this->UsersModel->updatePasswordUsers($userData)) {
                    echo json_encode('Contraseña Actualizada');
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

    /**
     * The function `listUsersRoles` retrieves user roles data based on the provided ID and returns it
     * in a JSON format for DataTables usage.
     * 
     * @param id The `listUsersRoles` function in the code snippet you provided seems to be a part of a
     * PHP script that handles the listing of roles for a specific user based on the `` parameter
     * passed to the function.
     */
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

/**
 * The function `addRolesUsers` assigns a role to a user and handles validation and error messages
 * accordingly.
 * 
 * @param ROLE_PK The `ROLE_PK` parameter in the `addRolesUsers` function represents the primary key of
 * the role that you want to assign to a user. This parameter is used to identify the specific role
 * that you are assigning to a user within your application.
 * @param USER_PK The `USER_PK` parameter in the `addRolesUsers` function represents the primary key of
 * a user in the system. This parameter is used to identify the user to whom a role is being assigned
 * or updated within the function logic.
 */

    public function addRolesUsers($ROLE_PK, $USER_PK)
    {
        //echo $ROLE_PK . "/" . $USER_PK;
        $validacion = $this->UsersrolesModel->validateUsersRolesId($USER_PK, $ROLE_PK);
        echo json_encode( $validacion);
        if ($validacion) {
            if ($this->UsersrolesModel->updateStateUsersRolesId($validacion->USRL_PK, $this->session->get('USER_PK'))) {
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
        //$validacion = $this->UsersrolesModel->validateUsersRolesId($USER_PK, $ROLE_PK);
       // echo json_encode($this->UsersrolesModel->updateStateUsersRolesId($validacion->USRL_PK, $this->session->get('USER_PK')));
    }




    public function prueba()
    {
        //$Roles =[8,6,7];
        //$permissions = $this->RolespermissionsModel->validatePermissionsRole($Roles);
        $Roles =  $this->UsersRuvModel->prueba();
        echo json_encode($Roles);
    }
}

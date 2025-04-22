<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Entities\Amas\UsersEntity;

class UsersController extends BaseController
{

    protected $UserEntity;

    public function __construct()
    {
        $this->UserEntity = new UsersEntity();
    }

    private function jsonResponse(string $status, string $message, int $code = 200)
    {
        return $this->response
            ->setStatusCode($code)
            ->setJSON(['status' => $status, 'message' => $message]);
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
        $roles = $this->UsersrolesModel->validateRolesUser($this->session->get('USER_PK'));
        return $this->response->setJSON($roles);
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
        $roles = $this->UsersrolesModel->validateRolesUser($this->session->get('USER_PK'));
        $menu = generate_menu($roles);
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
         $data = $this->UsersModel->listUsers();
         return $this->buildDataTableResponse($data);
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
        $password = $this->request->getPost('USER_password');
        $passwordConf = $this->request->getPost('USER_password_two');
        $identification = $this->request->getPost('USER_identification');

        if ($password !== $passwordConf) {
            return $this->jsonResponse('error', 'Las contraseñas no coinciden', 401);
        }

        if (!$this->UsersModel->validateUserDoc($identification)) {
            return $this->jsonResponse('error', 'El usuario ya existe', 401);
        }

        $this->UserEntity->fill([
            'USER_name' => $this->request->getPost('USER_name'),
            'USER_username' => $this->request->getPost('USER_username'),
            'USER_identification' => $identification,
            'USER_password' => $password,
            'USER_date_create' => date('Y-m-d H:i:s'),
            'USER_date_update' => date('Y-m-d H:i:s'),
            'USER_FK_user_create' => $this->session->get('USER_PK'),
            'USER_FK_user_update' => $this->session->get('USER_PK'),
            'USER_FK_state_user' => 1,
            'USER_reset_password' => 1,
            'USER_email' => $this->request->getPost('USER_email'),
            'USER_address_ip' => $this->request->getPost('USER_address_ip'),
        ]);

        if ($this->UsersModel->insert($this->UserEntity)) {
            return $this->jsonResponse('success', 'Usuario creado correctamente');
        }

        return $this->jsonResponse('error', 'Error al crear el usuario', 500);
    }
    

   /**
    * The PHP function `login` handles user authentication by validating credentials, IP address, and
    * user status before setting session data or returning appropriate error messages.
    */
    public function login()
    {
        $username = $this->request->getPost('USER_username');
        $password = $this->request->getPost('USER_password');
        $addressIp = $this->request->getIPAddress();

        if (empty($username) || empty($password)) {
            return $this->jsonResponse('error', 'Por favor ingresa los datos completos', 400);
        }
        $this->UserEntity->fill([
            'USER_username' => $username,
            'USER_password' => $password,
        ]);
        $user = $this->UsersModel->validateUser($this->UserEntity);
    
        if (!$user) {
            return $this->jsonResponse('error', 'Usuario o contraseña no coinciden', 401);
        }
    
        if (!$this->UsersModel->validateIPUser($user->USER_PK, $addressIp)) {
            return $this->jsonResponse('error', 'La dirección IP no coincide con la registrada', 403);
        }
        if ($user->USER_FK_state_user !== '1') {
            return $this->jsonResponse('error', 'Usuario inactivo, contacte al administrador', 403);
        }
    
        // Roles o permisos
        $permissions = $this->UsersrolesModel->validateRolesUser($user->USER_PK);

        $this->session->set([
            'USER_PK' => $user->USER_PK,
            'USER_name' => $user->USER_name,
            'USER_username' => $user->USER_username,
            'PERMISSIONS' => $permissions
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'msg' => 'Autenticación exitosa',
            'USER_PK' => $user->USER_PK,
            'USER_reset_password' => $user->USER_reset_password
        ]);
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
         return $this->jsonResponse('success', 'Sesión cerrada correctamente');
     }
    /**
     * The function `updateUsers` updates user data in a PHP application based on the provided input.
     */

    public function updateUsers()
    {
        $this->UserEntity->fill([
            'USER_PK' => $this->request->getPost('USER_PK'),
            'USER_name' => $this->request->getPost('USER_name'),
            'USER_username' => $this->request->getPost('USER_username'),
            'USER_identification' => $this->request->getPost('USER_identification'),
            'USER_date_update' => date('Y-m-d H:i:s'),
            'USER_FK_user_update' => $this->session->get('USER_PK'),
            'USER_email' => $this->request->getPost('USER_email'),
            'USER_address_ip' => $this->request->getPost('USER_address_ip'),
        ]);

        if ($this->UsersModel->updateUsers($this->UserEntity)) {
            return $this->jsonResponse('success', 'Usuario actualizado correctamente');
        }
    
        return $this->jsonResponse('error', 'Error al actualizar usuario', 401);
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
        $user = $this->UsersModel->validateUserId($id);
    
        if (!$user) {
            return $this->jsonResponse('error', 'Usuario no encontrado', 404);
        }
    
        $user->USER_FK_state_user = $user->USER_FK_state_user == 1 ? 0 : 1;
    
        if ($this->UsersModel->updateUsers($user)) {
            return $this->jsonResponse('success', 'Estado actualizado correctamente');
        }
    
        return $this->jsonResponse('error', 'Error al actualizar estado del usuario', 500);
    }
    

   /**
    * The function `updatePasswordUsers` in PHP checks if two passwords match, updates the user's
    * password in the database, and sets appropriate response status codes based on the outcome.
    */
    public function updatePasswordUsers()
    {
        $password = $this->request->getPost('USER_password_P');
        $passwordRepeat = $this->request->getPost('USER_password_two_P');

        if ($password !== $passwordRepeat) {
            return $this->jsonResponse('error', 'Las contraseñas no coinciden', 402);
        }

        $userId = $this->request->getPost('USER_PK_P');
        $user = $this->UsersModel->validateUserId($userId);
        if (!$user) {
            return $this->jsonResponse('error', 'Usuario no encontrado', 404);
        }

        $user->USER_password = $password;
        $user->USER_reset_password = 1;
        $user->USER_FK_user_update = $this->session->get('USER_PK');

        if ($this->UsersModel->updatePasswordUsers($user)) {
            return $this->jsonResponse('success', 'Contraseña actualizada correctamente', 201);
        }

        return $this->jsonResponse('error', 'Error al actualizar la contraseña', 500);
    }
    
    /**
     * The function `UpdatePasswordUser` in PHP validates and updates a user's password based on input
     * data.
     */
    public function UpdatePasswordUser()
    {
        $userId = $this->request->getPost('USER_PK_P');
        $currentPass = $this->request->getPost('USER_password_A');
        $newPass = $this->request->getPost('USER_password_P');
        $newPassConfirm = $this->request->getPost('USER_password_two_P');

        $user = $this->UsersModel->validateUserId($userId);
        if (!$user) {
            return $this->jsonResponse('error', 'Usuario no encontrado', 404);
        }

        if (!$this->UsersModel->validatePasswords($currentPass, $user->USER_password)) {
            return $this->jsonResponse('error', 'La contraseña actual no coincide', 403);
        }

        if ($newPass !== $newPassConfirm) {
            return $this->jsonResponse('error', 'Las nuevas contraseñas no coinciden', 402);
        }

        $this->UserEntity->fill([
            'USER_PK'             => $userId,
            'USER_password'       => $newPass,
            'USER_reset_password' => 0,
            'USER_date_update'    => date('Y-m-d H:i:s'),
        ]);

        if ($this->UsersModel->updatePasswordUsers($this->UserEntity)) {
        return $this->jsonResponse('success', 'Contraseña actualizada correctamente', 201);
        }

        return $this->jsonResponse('error', 'Error al actualizar la contraseña', 401);
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
        $data = $this->UsersrolesModel->listUsersRoles($id);
        return $this->buildDataTableResponse($data);
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
        $currentUser = $this->session->get('USER_PK');
        $roleExists = $this->UsersrolesModel->validateUsersRolesId($USER_PK, $ROLE_PK);
        if ($roleExists) {
            if ($this->UsersrolesModel->updateStateUsersRolesId($roleExists->USRL_PK, $currentUser)) {
                return $this->jsonResponse('success', 'Rol asignado exitosamente');
            }
            return $this->jsonResponse('error', 'Error al asignar el permiso', 401);
        }
     
        $data = [
            'USRL_date_create' => date('Y-m-d H:i:s'),
            'USRL_date_update' => date('Y-m-d H:i:s'),
            'USRL_user_create' => $currentUser,
            'USRL_user_update' => $currentUser,
            'USRL_FK_rol' => $ROLE_PK,
            'USRL_FK_user' => $USER_PK,
            'USRL_state' => 1,
        ];

        if ($this->UsersrolesModel->addStateUsersRolesId($data)) {
            return $this->jsonResponse('success', 'Rol agregado exitosamente');
        }

        return $this->jsonResponse('error', 'Error al agregar rol', 401);
    }

    /**
     * The function `buildDataTableResponse` constructs a JSON response for a DataTable with
     * information about the data and records.
     * 
     * @param data The `data` parameter in the `buildDataTableResponse` function is expected to be an
     * object that represents a dataset, likely retrieved from a database query. This dataset should
     * have methods like `getNumRows()` and `getResultArray()` that provide information about the data
     * and allow access to the actual data rows
     * 
     * @return The function `buildDataTableResponse` is returning a JSON response with the following
     * structure:
     * - "draw": The value of the "draw" parameter from the POST request, casted to an integer.
     * - "recordsTotal": The total number of rows in the dataset.
     * - "recordsFiltered": The total number of rows in the dataset (same as "recordsTotal" in this
     * case).
     * - "
     */
    private function buildDataTableResponse($data)
    {
        return $this->response->setJSON([
            "draw" => (int) $this->request->getPost("draw"),
            "recordsTotal" => $data->getNumRows(),
            "recordsFiltered" => $data->getNumRows(),
            "data" => $data->getResultArray()
        ]);
    }
}

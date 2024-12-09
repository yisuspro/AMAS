<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
//use App\Models\RolesModel;

class RolesController extends BaseController
{


    public function __construct()
    {
        
    }

    /**
     * The index function returns a view for listing roles with the title "Listar roles".
     * 
     * @return A view named 'listRolesAjax' located in the 'private/views_ajax/roles' directory is
     * being returned with the title 'Listar roles' passed as data.
     */
    public function index()
    {
        return view('private/views_ajax/roles/listRolesAjax', ['title' => 'Listar roles']);
    }

    /**
     * The function `listRoles` retrieves a list of roles from the model and returns it as a JSON
     * response with pagination information.
     * 
     * @return The `listRoles()` function returns a JSON response containing the following data:
     * - "draw": The draw number received from the client
     * - "recordsTotal": Total number of roles fetched from the model
     * - "recordsFiltered": Total number of roles (same as "recordsTotal" as no filtering logic
     * applied)
     * - "data": An array of role data fetched from the model
     */
    public function listRoles()
    {
        $draw   = intval($this->request->getPost("draw"));   // Fetch draw variable
        $start  = intval($this->request->getPost("start"));  // Fetch start variable
        $length = intval($this->request->getPost("length")); // Fetch length variable

        // Fetch the list of roles from the model
        $data = $this->RolesModel->listRoles();

        // If no data returned, handle the error
       /* if (!$data) {
            $this->response->setStatusCode(404, 'No roles found');
        }
*/
        // Prepare the output array
        $output = [
            "draw" => $draw,                              // The draw number to return to the client
            "recordsTotal" => $data->getNumRows(),        // Total number of roles
            "recordsFiltered" => $data->getNumRows(),     // Total number of filtered roles (same here as no filtering logic applied)
            "data" => $data->getResultArray()             // The role data in array format
        ];

        // Send the response as JSON
        //$this->response->setStatusCode(200)->setBody($output);
        echo json_encode($output);
        exit;
    }


    /**
     * The function `createRoles` creates a new role with specified data and returns a success or error
     * response.
     * 
     * @return If the `insertRoles` method of the `RolesModel` successfully inserts the role data into
     * the database, a response with status code 201 will be returned. If there is an error during the
     * creation process, a response with the message 'Error al crear permiso' and status code 401 will
     * be returned.
     */
    public function createRoles()
    {
        // Retrieve data from the POST request
        $rolData = [
            'ROLE_name' => $this->request->getPost('ROLE_name'),
            'ROLE_description' => $this->request->getPost('ROLE_description'),
            'ROLE_date_create' => date('Y-m-d H:i:s'),
            'ROLE_date_update' => date('Y-m-d H:i:s'),
            'ROLE_FK_user_create' => $this->session->get('USER_PK'),
            'ROLE_FK_user_update' => $this->session->get('USER_PK'),
            'ROLE_state' => 1
        ];

        if ($this->RolesModel->insertRoles($rolData)) {
            $this->response->setStatusCode(201);
        } else {
            $this->response->setStatusCode(401,'Error al crear permiso');
        }
    }

    /**
     * This PHP function retrieves role data from the database and passes it to a view for updating
     * roles.
     * 
     * @param id The `updateRolesView` function appears to be a method within a PHP class. It takes an
     * `` parameter as input. This function is responsible for fetching data related to roles using
     * the `viewRoles` method from the `RolesModel` class and then passing this data to a view file
     * 
     * @return The `updateRolesView` function is returning a view called 'updateRolesAjax' located in
     * 'private/views_ajax/roles' directory. It is passing an array with the title 'Actualizar Roles'
     * and the data retrieved from the `viewRoles` method in the `RolesModel` model. The data is
     * converted to an array using `getResultArray()` method before being passed to the view.
     */
    public function updateRolesView($id)
    {
        $data = $this->RolesModel->viewRoles($id);

        return view('private/views_ajax/roles/updateRolesAjax', ['title' => 'Actualizar Roles', 'data' => $data->getResultArray()]);
    }

    /**
     * The function `updateRoles` in PHP updates role data based on POST request inputs after validation
    * and checking for role existence.
    * 
    * @return The function `updateRoles` is returning different HTTP status codes along with
    * corresponding messages based on the conditions met during its execution. Here are the possible
    * return values:
    */
    public function updateRoles()
    {
        // Retrieve role data from POST request
        $roleData = [
            'ROLE_PK' => $this->request->getPost('ROLE_PK'),
            'ROLE_name' => $this->request->getPost('ROLE_name'),
            'ROLE_description' => $this->request->getPost('ROLE_description'),
            'ROLE_date_update' => date('Y-m-d H:i:s'),
            'ROLE_user_update' => $this->session->get('USER_PK'),
            'ROLE_state' => 1
        ];

        // Validate the inputs
        if (empty($roleData['ROLE_name']) || empty($roleData['ROLE_description'])) {
            return $this->response->setStatusCode(400,'El nombre y la descripción del rol son obligatorios');
        }


        // Check if the role exists using the provided ROLE_PK
        if ($this->RolesModel->validateRolesId($roleData['ROLE_PK'])) {
            // Attempt to update the role in the database
            if ($this->RolesModel->updateRoles($roleData)) {
                $this->response->setStatusCode(201,'Rol actualizado con éxito');
            } else {
                $this->response->setStatusCode(401,'Error al actualizar el rol');
            }
        } else {
            $this->response->setStatusCode(404,'El rol no se encuentra');
        }
    }

    /**
     * The function `updateStateRoles` toggles the state of a role based on the provided ID and updates
     * it in the database, returning success or failure messages accordingly.
     * 
     * @param id The `updateStateRoles` function you provided seems to be updating the state of a role
     * based on the provided ID. The ID parameter is used to fetch the role data that needs to be
     * updated.
     * 
     * @return This function returns a response based on the outcome of updating the state of a role in
     * the database. If the role with the provided ID is not found, it returns a 404 status code with a
     * message "Rol no encontrado". If the role exists, it toggles the state of the role and attempts
     * to update it in the database.
     */
    public function updateStateRoles($id)
    {
        // Fetch the role data based on the provided ID
        $role = $this->RolesModel->validateRolesId($id);
    
        // Check if the role exists
        if (!$role) {
            $this->response->setStatusCode(404,'Rol no encontrado');
        }
    
        // Toggle the role state
        $role['ROLE_state'] = ($role['ROLE_state'] == 1) ? 0 : 1;
    
        // Attempt to update the role's state in the database
        if ($this->RolesModel->updateRoles($role)) {
            $this->response->setStatusCode(201,'Estado del rol actualizado con éxito');
        } else {
            $this->response->setStatusCode(401,'Error al actualizar el estado del rol');
        }
    }

    /**
     * The function `addPermissionsRolesViews` returns a view for assigning permissions to roles with
     * specified title and ID.
     * 
     * @param id The `id` parameter in the `addPermissionsRolesViews` function is used to pass the
     * identifier of a specific role or entity to the view. In this case, it is being passed to the
     * view 'private/views_ajax/roles/addPermissionsRolesAjax' along with the title 'Asignar
     * 
     * @return A view named 'addPermissionsRolesAjax' located in the 'private/views_ajax/roles'
     * directory is being returned with the data array containing the keys 'title' with the value
     * 'Asignar permisos' and 'id' with the value of the parameter .
     */
    public function addPermissionsRolesViews($id)
    {
        return view('private/views_ajax/roles/addPermissionsRolesAjax', ['title' => 'Asignar permisos ',  'id' => $id]);
    }

    /**
     * This PHP function retrieves roles and permissions data based on ID and pagination parameters,
     * returning the results as a JSON response or handling errors accordingly.
     * 
     * @param id The `id` parameter in the `listRolesPermissions` function is used to identify which roles
     * and permissions data to retrieve from the model. It is passed as an argument to the function and
     * then used in querying the database to fetch the relevant information based on this identifier.
     */
    public function listRolesPermissions($id)
    {
        // Retrieve pagination parameters from the request
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
    
        // Fetch data from the model using the provided ID and pagination parameters
        $data = $this->RolespermissionsModel->listRolesPermissions($id, $start, $length);
    
        // Check if data retrieval was successful
        if ($data) {
            $output = [
                "draw" => $draw,  // The draw parameter for the table to handle pagination
                "recordsTotal" => $data->getNumRows(),  // Total records in the database (without filtering)
                "recordsFiltered" => $data->getNumRows(),  // Total records after filtering
                "data" => $data->getResultArray()  // Data to display in the table
            ];
    
            // Return the data as a JSON response
            echo json_encode($output);
        } else {
            // Handle error if data is not retrieved properly
            $this->response->setStatusCode(500)->setBody(['error' => 'Error retrieving data']);
        }
    
        exit;  // Ensure the script terminates after sending the response
    }
    
    /**
     * The function `addPermissionsRoles` checks if a role-permission association exists, updates its state
     * if it does, and creates a new association if it doesn't.
     * 
     * @param permission The code you provided is a PHP function that adds permissions to roles in a
     * system. It first checks if the role-permission association already exists. If it does, it updates
     * the state of the association. If it doesn't exist, it creates a new association.
     * @param rol The `rol` parameter in the `addPermissionsRoles` function represents the role to which a
     * permission is being assigned or added. It is used to associate a permission with a specific role in
     * the system.
     */
    public function addPermissionsRoles($permission, $rol)
    {
        // Validate if the role-permission association already exists
        $validacion = $this->RolespermissionsModel->validateRolesPermissionsId($rol, $permission);
    
        if ($validacion) {
            // If association exists, update its state
            $userUpdate = $this->session->get('USER_PK');
            if ($this->RolespermissionsModel->updateStateRolesPermissionsId($validacion['RLPR_PK'], $userUpdate)) {
                $this->response->setStatusCode(200)->setBody(['message' => 'Permiso asignado exitosamente']);
            } else {
                $this->response->setStatusCode(401)->setBody(['error' => 'Error al asignar el permiso']);
            }
        } else {
            // If association does not exist, create a new one
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
                $this->response->setStatusCode(200)->setBody(['message' => 'Permiso agregado exitosamente']);
            } else {
                $this->response->setStatusCode(200)->setBody(['error' => 'Error al agregar permiso']);
            }
        }
    }
    
}

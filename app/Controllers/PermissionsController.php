<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
//use App\Models\PermissionsModel;

class PermissionsController extends BaseController
{

    //protected $PermissionsModel;

    public function __construct()
    {
       // $this->PermissionsModel = new PermissionsModel();
    }

    /**
     * The index function returns a view for listing permissions with a specified title.
     * 
     * @return A view named 'listPermissionsAjax' located in the 'private/views_ajax/permissions'
     * directory is being returned with the title 'Listar Permisos'.
     */
    public function index()
    {
        return view('private/views_ajax/permissions/listPermissionsAjax', ['title' => 'Listar Permisos']);
    }

    /**
     * The function `updatePermissionsView` retrieves permission data from the model and passes it to a
     * view for updating permissions.
     * 
     * @param id The `updatePermissionsView` function is used to retrieve permissions data for a
     * specific ID and pass it to a view for updating permissions. The function takes an ``
     * parameter which is used to identify the specific permissions data to be retrieved.
     * 
     * @return The `updatePermissionsView` function is returning a view called 'updatePermissionsAjax'
     * located in the 'private/views_ajax/permissions' directory. It is passing an array with the title
     * 'Actualizar Permisos' and the data retrieved from the `viewPermissions` method in the
     * `PermissionsModel` model, converted to an array using `getResultArray()`.
     */
    public function updatePermissionsView($id)
    {
        $data = $this->PermissionsModel->viewPermissions($id);

        return view('private/views_ajax/permissions/updatePermissionsAjax', ['title' => 'Actualizar Permisos', 'data' => $data->getResultArray()]);
    }


    /**
     * The function retrieves permissions data, prepares a response for pagination, and outputs it in
     * JSON format.
     */
    public function listPermissions()
    {
        // Retrieve the request parameters (draw, start, length)
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
    
        // Fetch the permissions data from the model
        $permissionsData = $this->PermissionsModel->listPermissions();
    
        // Get the number of rows (total count) to use for pagination
        $totalRecords = $permissionsData->getNumRows();
    
        // Prepare the output response
        $output = [
            "draw" => $draw,                                    // Table drawing counter
            "recordsTotal" => $totalRecords,                     // Total number of records
            "recordsFiltered" => $totalRecords,                  // Filtered records (same as total for now)
            "data" => $permissionsData->getResultArray()         // Result data
        ];
    
        // Return the JSON-encoded response
        echo json_encode($output);
        exit;
    }
    
    /**
     * The function creates permissions by processing request data, checking for existing system names, and
     * inserting the permission data into the database.
     * 
     * @return a response with a status code. If the permission system name already exists, it returns a
     * response with a status code of 401 and an error message. If the permission is successfully created
     * and inserted into the database, it returns a response with a status code of 201. If there is an
     * error during the creation process, it returns a response with a status code of 401
     */
    public function createPermissions()
    {
        // Prepare permission data from the request
        $permissionData = [
            'PRMS_name'        => $this->request->getPost('PRMS_name'),
            'PRMS_description' => $this->request->getPost('PRMS_description'),
            'PRMS_system_name' => $this->request->getPost('PRMS_system_name'),
            'PRMS_date_create' => date('Y-m-d H:i:s'),
            'PRMS_date_update' => date('Y-m-d H:i:s'),
            'PRMS_user_create' => $this->session->get('USER_PK'),
            'PRMS_user_update' => $this->session->get('USER_PK'),
            'PRMS_state'       => 1
        ];
        // Check if the permission system name already exists
        if ($this->PermissionsModel->validatePermissions($permissionData['PRMS_system_name'])) {
            echo json_encode('Error nombre corto de permiso ya existe');
            $this->response->setStatusCode(401);
        } else {   
            if ($this->PermissionsModel->insertPermissions($permissionData)) {
                $this->response->setStatusCode(201);
            } else {
                $this->response->setStatusCode(401,'Error al crear permiso');
            }
        }
    }

    /**
     * The function `updatePermissions` in PHP updates permission data based on the request and returns
     * appropriate response statuses.
     * 
     * @return The function `updatePermissions` will return a response with status code 201 if the
     * permissions are successfully updated. If the permission with the provided ID does not exist, it will
     * return a response with status code 401 and an error message indicating that the permission was not
     * found. If there is an error during the update process, it will return a response with status code
     * 401 and an error message indicating
     */
    public function updatePermissions()
    {
        // Prepare permission data from the request
        $permissionData = [
            'PRMS_PK'          => $this->request->getPost('PRMS_PK'),
            'PRMS_name'        => $this->request->getPost('PRMS_name'),
            'PRMS_description' => $this->request->getPost('PRMS_description'),
            'PRMS_system_name' => $this->request->getPost('PRMS_system_name'),
            'PRMS_date_update' => date('Y-m-d H:i:s'),
            'PRMS_user_update' => $this->session->get('USER_PK'),
            'PRMS_state'       => 1
        ];

        // Check if the permission exists by ID
        if (!$this->PermissionsModel->validatePermissionsId($permissionData['PRMS_PK'])) {
            echo json_encode('Error no se encuentra permiso');
            $this->response->setStatusCode(401);
        }
    
        if ($this->PermissionsModel->updatePermissions($permissionData)) {
            $this->response->setStatusCode(201);
        } else {
            $this->response->setStatusCode(401,'Error al actualizar el permiso');
        }     
    }

    
    /**
     * This PHP function updates the state of a permission by toggling its value between 0 and 1 after
     * validating its existence.
     * 
     * @param id The code snippet you provided is a PHP function that updates the state of a permission
     * based on the given ID. The function first validates if the permission exists by the provided ID,
     * toggles the permission state (from 1 to 0 or 0 to 1), and then attempts to update the
     * 
     * @return The function `updateStatePermissions` returns different responses based on the outcome
     * of the permission state update process. Here are the possible return values:
     */
    public function updateStatePermissions($id)
    {
        // Validate if the permission exists by ID
        $result = $this->PermissionsModel->validatePermissionsId($id);
    
        if (!$result) {
            $this->response->setStatusCode(404,'Permiso no encontrado');
        }
    
        // Toggle the permission state (1 -> 0 or 0 -> 1)
        $result['PRMS_state'] = ($result['PRMS_state'] == 1) ? 0 : 1;
    
        // Try updating the permission state
        if ($this->PermissionsModel->updatePermissions($result)) {
            $this->response->setStatusCode(201,'Estado del permiso actualizado correctamente');
        } else {   
            // If the update fails, return an error
            $this->response->setStatusCode(401,'Error al actualizar estado del permiso');
        }
    }
     
}

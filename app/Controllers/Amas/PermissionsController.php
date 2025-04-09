<?php

namespace App\Controllers\Amas;

use App\Controllers\BaseController;
use App\Entities\Amas\PermissionsEntity;

class PermissionsController extends BaseController
{

    protected $PermissionsEntity;

    public function __construct()
    {
       $this->PermissionsEntity = new PermissionsEntity();
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

        return view('private/views_ajax/permissions/updatePermissionsAjax', [
            'title' => 'Actualizar Permisos',
            'data' => $data
        ]);
    }


    /**
     * The function retrieves permissions data, prepares a response for pagination, and outputs it in
     * JSON format.
     */
    public function listPermissions()
    {
        $draw = (int) $this->request->getPost("draw");
        $permissionsData = $this->PermissionsModel->listPermissions();
        $totalRecords = $permissionsData->getNumRows();

        return $this->response->setJSON([
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $permissionsData->getResultArray()
        ]);
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
        $systemName = $this->request->getPost('PRMS_system_name');
        
        if ($this->PermissionsModel->validatePermissions($systemName)) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON(['error' => 'Error: nombre corto de permiso ya existe']);
        }

        $this->fillPermissionEntity();
        
        if ($this->PermissionsModel->insertPermissions($this->PermissionsEntity)) {
            return $this->response->setStatusCode(201);
        }

        return $this->response
            ->setStatusCode(401)
            ->setJSON(['error' => 'Error al crear permiso']);
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
        $permissionId = $this->request->getPost('PRMS_PK');
        
        if (!$this->PermissionsModel->validatePermissionsId($permissionId)) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Error: permiso no encontrado']);
        }

        $this->fillPermissionEntity();
        
        if ($this->PermissionsModel->updatePermissions($this->PermissionsEntity)) {
            return $this->response->setStatusCode(201);
        }

        return $this->response
            ->setStatusCode(401)
            ->setJSON(['error' => 'Error al actualizar el permiso']);
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
        $permission = $this->PermissionsModel->validatePermissionsId($id);
        
        if (!$permission) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Permiso no encontrado']);
        }
        $permission->PRMS_state = $permission->PRMS_state == 1 ? 0 : 1;
        if ($this->PermissionsModel->updatePermissions($permission)) {
            return $this->response
                ->setStatusCode(201)
                ->setJSON(['message' => 'Estado del permiso actualizado correctamente']);
        }

        return $this->response
            ->setStatusCode(401)
            ->setJSON(['error' => 'Error al actualizar estado del permiso']);
    }
     
    
    /**
     * The function `fillPermissionEntity` populates a permissions entity with data from a request and
     * sets create/update information based on the request data.
     */
    private function fillPermissionEntity()
    {
        $this->PermissionsEntity->fill([
            'PRMS_PK'          => $this->request->getPost('PRMS_PK'),
            'PRMS_name'        => $this->request->getPost('PRMS_name'),
            'PRMS_description' => $this->request->getPost('PRMS_description'),
            'PRMS_system_name' => $this->request->getPost('PRMS_system_name'),
            'PRMS_date_update' => date('Y-m-d H:i:s'),
            'PRMS_user_update' => $this->session->get('USER_PK'),
            'PRMS_state'       => 1
        ]);

        // Only set create date and user for new records
        if (!$this->request->getPost('PRMS_PK')) {
            $this->PermissionsEntity->PRMS_date_create = date('Y-m-d H:i:s');
            $this->PermissionsEntity->PRMS_user_create = $this->session->get('USER_PK');
        }
    }
}
